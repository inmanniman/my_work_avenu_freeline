<?php
/**
 * Импорт товаров и категорий из файла YML
 * 
 * @package    DIAFAN.CMS
 * @author     diafan.ru
 * @version    7.0
 * @license    http://www.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2022 OOO «Диафан» (http://www.diafan.ru/)
 */

if (! defined('DIAFAN'))
{
	$path = __FILE__;
	while(! file_exists($path.'/includes/404.php'))
	{
		$parent = dirname($path);
		if($parent == $path) exit;
		$path = $parent;
	}
	include $path.'/includes/404.php';
}


/**
 * Shop_ymlimport
 *
 * Импорт товаров в Яндекс.Маркет
 */
class Shop_ymlimport extends Diafan
{
	/**
	 * @var integer максимальное количество товаров, выгружаемых за одну итерацию
	 */
	private $max = 10;

	/**
	 * @var array данные для добавления в бд
	 */
	private $rows = array();

	/**
	 * @var array страница с прикрепленным модулем shop, на которую будут выгружены данные
	 */
	private $site;

	/**
	 * @var string поле, которое используется в качестве идентификаторов
	 */
	private $id_field = 'id'; // или import_id

	/**
	 * @var string поле, которое используется в качестве идентификаторов характеристик
	 */
	private $param_name = 'yandex_name'; // или [name]

	/**
	 * Инициирует создание YML файла
	 *
	 * @return void
	 */
	public function init()
	{
		if(empty($_GET["secret"]))
		{
			Custom::inc('includes/404.php');
		}

		$rows = DB::query_fetch_all("SELECT id FROM {site} WHERE trash='0' AND [act]='1' AND module_name='shop' AND access='0'");
		foreach ($rows as $row)
		{
			if(! $this->diafan->configmodules('yandex_import', 'shop', $row["id"]) || (! $this->diafan->configmodules('yandex_import_filename', 'shop', $row["id"]) && ! $this->diafan->configmodules('yandex_import_url', 'shop', $row["id"])))
			{
				continue;
			}

			if($_GET["secret"] == $this->diafan->configmodules('yandex_import_secret', 'shop', $row["id"]))
			{
				$this->site = array(
					'id' => $row["id"],
					'url' => $this->diafan->configmodules('yandex_import_url', 'shop', $row["id"]),
					'filename' => $this->diafan->configmodules('yandex_import_filename', 'shop', $row["id"]),
					'secret' => $this->diafan->configmodules('yandex_import_secret', 'shop', $row["id"]),
				);
				break;
			}
		}

		if (! $this->site)
		{
			Custom::inc('includes/404.php');
		}
		
		if(empty($_GET["rewrite"]))
		{
			if(! $this->diafan->configmodules("token_".$this->site["id"], "yandex_import"))
			{
				if (! empty($this->site['url']))
				{
					$this->upload();
		
					if (empty($this->site['uploaded']))
					{
						echo $this->diafan->_('Не удалось получить данные по адресу %s.', false, $this->site['url']);
						return;
					}
				}
			}
		}

		if(! file_exists(ABSOLUTE_PATH.'tmp/yml/'.trim($this->site["filename"])))
		{
			echo $this->diafan->_('Файл %s не существует.', false, $this->site["filename"]);
			return;
		}

		if($_GET["rewrite"] == 'do')
		{
			if(! $this->diafan->configmodules("token_".$this->site["id"], "yandex_import"))
			{
				return;
			}
			$start = $this->do_i();
			$this->insert();
			if(! $start)
			{
				$this->fast(BASE_PATH.'shop/ymlimport/finish/?token='.$this->diafan->configmodules("token_".$this->site["id"], "yandex_import").'&time='.time().'&secret='.$this->site["secret"]);
			}
			else
			{
				$this->fast(BASE_PATH.'shop/ymlimport/do/?token='.$this->diafan->configmodules("token_".$this->site["id"], "yandex_import").'&time='.time().'&secret='.$this->site["secret"].'&start='.$start);
			}
			return;
		}

		if($_GET["rewrite"] == 'finish')
		{
			if(! $this->diafan->configmodules("token_".$this->site["id"], "yandex_import"))
			{
				echo 'complete';
				return;
			}
			$start = $this->finish();
			if(! $start)
			{
				$this->diafan->configmodules("token_".$this->site["id"], "yandex_import", 0, false, '');
				$this->diafan->configmodules("count_goods_".$this->site["id"], "yandex_import", 0, false, '');
				$this->diafan->configmodules("count_cats_".$this->site["id"], "yandex_import", 0, false, '');
			}
			else
			{
				$this->fast(BASE_PATH.'shop/ymlimport/finish/?token='.$this->diafan->configmodules("token_".$this->site["id"], "yandex_import").'&time='.time().'&secret='.$this->site["secret"].'&start='.$start);
			}
			return;
		}

		if($_GET["rewrite"] == 'wait')
		{
			if(! $this->diafan->configmodules("token_".$this->site["id"], "yandex_import"))
			{
				echo $this->diafan->_('Загрузка файла %s завершена.', false, $this->site["filename"]);
				return;
			}
			echo $this->diafan->_('Продолжается обработка файла %s. Загружено: категорий - %d, товаров - %d.', false, $this->site["filename"], 
				$this->diafan->configmodules("count_cats_".$this->site["id"], "yandex_import"),
				$this->diafan->configmodules("count_goods_".$this->site["id"], "yandex_import")
			);
			echo '<script language="javascript" type="text/javascript">
				setTimeout(\'window.location.href="'.BASE_PATH.'shop/ymlimport/wait/?time='.time().'&secret='.$this->site["secret"].'";\', 1000)</script>';
			return;
		}

		if(empty($_GET["rewrite"]))
		{
			if(! $this->diafan->configmodules("token_".$this->site["id"], "yandex_import"))
			{
				$token = mt_rand(0, 9999999).time();

				$this->diafan->configmodules("token_".$this->site["id"], "yandex_import", 0, false, $token);

				if($this->id_field != "id" && ! $row = DB::query_fetch_array("SHOW COLUMNS FROM {shop_category} WHERE `Field`='import_parent_id'"))
				{
					DB::query("ALTER TABLE {shop_category} ADD `import_parent_id` VARCHAR(100) NOT NULL AFTER `import_id`");
				}

				if($this->id_field != "id" && ! $row = DB::query_fetch_array("SHOW COLUMNS FROM {shop} WHERE `Field`='import_cat_id'"))
				{
					DB::query("ALTER TABLE {shop} ADD `import_cat_id` VARCHAR(100) NOT NULL AFTER `import_id`");
				}

				$this->fast(BASE_PATH.'shop/ymlimport/do/?token='.$token.'&time='.time().'&secret='.$this->site["secret"]);
			}
		}
		echo '<script language="javascript" type="text/javascript">
			setTimeout(\'window.location.href="'.BASE_PATH.'shop/ymlimport/wait/?time='.time().'&secret='.$this->site["secret"].'";\', 1000)</script>';
	}
	
	private function upload()
	{
		File::create_dir('tmp/yml', true);

		$filename = '';

		if (! empty($this->site['filename']))
		{
			$filename = $this->site['filename'];
		}
		else
		{
			$filename = 'yandex_import_url.yml';

			$this->diafan->configmodules('yandex_import_filename', 'shop', $this->site['id'], false, $filename);
			$this->site['filename'] = $filename;
		}

		File::delete_file('tmp/yml/'.$filename);

		$temp = 'tmp/'.md5('yandeximporturl'.$this->diafan->uid());
		File::save_file('', $temp);

		try
		{
			$content = file_get_contents($this->site['url']);
			if ($content !== false && file_exists(ABSOLUTE_PATH.$temp))
			{
				if($f = fopen(ABSOLUTE_PATH.$temp, 'wb'))
				{
					fwrite($f, $content);
					fclose($f);
				}
				File::upload_file(ABSOLUTE_PATH.$temp, 'tmp/yml/'.$filename);

				$this->site['uploaded'] = true;
			}
		}
		catch (Exception $e)
		{
			File::delete_file($temp);
			File::delete_file('tmp/yml/'.$filename);
		}
	}

	private function do_i()
	{
		$reader = new XMLReader();
		$reader->open(ABSOLUTE_PATH.'tmp/yml/'.trim($this->site["filename"]));
		$reader->read();

		$i = 0;
		$start_i = $this->diafan->filter($_GET, "integer", "start");
		$current_i = 0;

		$is_end = false;
		do
		{
			$next = false;
			if($reader->localName == 'offer' || $reader->localName == 'category')
			{
				$i++;
				if($i > $start_i)
				{
					if($reader->localName == 'offer')
					{
						$this->offer($reader->expand());
					}
					else
					{
						$this->category($reader->expand());
					}
					$current_i++;
					if($current_i >= $this->max)
					{
						$reader->close();
						return $i;
					}
				}
				$is_end = $reader->next();
			}
			else
			{
				$is_end = $reader->read();
			}
		}
		while($is_end);
	}

	private function offer($row)
	{
		$r = array(
			"name" => '',
			"id" => 0,
			"yandex" => '',
			"price" => 0,
			"count" => 0,
			"old_price" => 0,
			"cat_id" => 0,
			"text" => '',
			"imgs" => array(),
			"param" => array(),
			"weight" => 0,
			"length" => 0,
			"width" => 0,
			"height" => 0,
			"article" => '',
			"brand" => '',
		);
		if($row->hasAttributes())
		{
			foreach($row->attributes as $a){
				if($a->nodeName == "id")
				{
					$r["id"] = $a->nodeValue;
				}
			}
		}
		if($row->childNodes)
		{
			foreach($row->childNodes as $n)
			{
				if($n->nodeName == "name")
				{
					$r["name"] = $n->nodeValue;
				}
				if(in_array($n->nodeName, array("vendor", "bid", "typePrefix", "model", "vendorCode", "sales_notes", "manufacturer_warranty", "country_of_origin")))
				{
					$r["yandex"] .= ($r["yandex"] ? "\n" : '').$n->nodeName.'='.$n->nodeValue;
				}
				if($n->nodeName == "vendor")
				{
					$r["brand"] = $n->nodeValue;
				}
				if($n->nodeName == "vendorCode")
				{
					$r["article"] = $n->nodeValue;
				}
				if($n->nodeName == "price")
				{
					$r["price"] = $n->nodeValue;
				}
				if($n->nodeName == "count")
				{
					$r["count"] = $n->nodeValue;
				}
				if($n->nodeName == "oldprice")
				{
					$r["old_price"] = $n->nodeValue;
				}
				if($n->nodeName == "categoryId")
				{
					$r["cat_id"] = $n->nodeValue;
				}
				if($n->nodeName == "picture")
				{
					$r["imgs"][] = $n->nodeValue;
				}
				if($n->nodeName == "description")
				{
					$r["text"] = $n->nodeValue;
				}
				if($n->nodeName == "param")
				{
					$p = array(
						'value' => $n->nodeValue,
						'name' => '',
						'unit' => '',
					);
					if($n->hasAttributes())
					{
						foreach($n->attributes as $a){
							if($a->nodeName == "unit")
							{
								$p["unit"] = $a->nodeValue;
							}
							if($a->nodeName == "name")
							{
								$p["name"] = $a->nodeValue;
							}
						}
					}
					$r["param"][] = $p;
				}
				if($n->nodeName == "weight")
				{
					if($this->diafan->configmodules('weight_unit', 'shop', $this->site["id"]) == "g")
					{
						$r["weight"] = $n->nodeValue * 1000;
					}
					else
					{
						$r["weight"] = $n->nodeValue;
					}
				}
				if($n->nodeName == "dimensions")
				{
					$v = explode('/', $n->nodeValue);
					if(! empty($v[0]))
					{
						$r["length"] = $n->nodeValue * 10;
					}
					if(! empty($v[1]))
					{
						$r["width"] = $n->nodeValue * 10;
					}
					if(! empty($v[2]))
					{
						$r["height"] = $n->nodeValue * 10;
					}
				}
			}
		}
		$this->rows["goods"][] = $r;
	}

	private function category($row)
	{
		$r = array(
			"name" => $row->nodeValue,
			"id" => 0,
			"parent_id" => 0,
		);
		if($row->hasAttributes())
		{
			foreach($row->attributes as $a){
				if($a->nodeName == "id")
				{
					$r["id"] = $a->nodeValue;
				}
				if($a->nodeName == "parentId")
				{
					$r["parent_id"] = $a->nodeValue;
				}
			}
		}
		$this->rows["cats"][] = $r;
	}

	private function insert()
	{
		if(! empty($this->rows["cats"]))
		{
			$ids = $this->diafan->filter($this->diafan->array_column($this->rows["cats"], "id"), "sql");
			$cats = DB::query_fetch_key_value("SELECT id".($this->id_field != "id" ? ", ".$this->id_field : '')
				." FROM {shop_category} WHERE ".$this->id_field." IN ('"
				.implode("','", $ids)."')"
				.($this->id_field != "id" ? " AND site_id=".$this->site["id"] : ''),
				$this->id_field, "id"
			);

			foreach($this->rows["cats"] as $row)
			{
				if(! isset($cats[$row["id"]]))
				{
					$s = "(";
					if($this->id_field == "id")
					{
						$s .= $this->diafan->filter($row["id"], "integer");
						$s .= ",".$this->diafan->filter($row["parent_id"], "integer");
					}
					else
					{
						$s .= "'".$this->diafan->filter($row["id"], "sql")."'";
						$s .= ", '".$this->diafan->filter($row["parent_id"], "sql")."'";
					}
					$s .= ",'".$this->diafan->filter($row["name"], "sql")."', "
					.$this->site["id"].", '1')";

					$id = DB::query("INSERT INTO {shop_category} ("
					.($this->id_field == "id" ? "id, parent_id" : $this->id_field.", import_parent_id")
					.", [name], site_id, `import`) VALUES ".$s);

					//ЧПУ
					if(ROUTE_AUTO_MODULE)
					{
						$this->diafan->_route->save('', $row["name"], $id, 'shop', 'cat', $this->site["id"], 0, ($this->id_field == "id" ? $row["parent_id"] : 0));
					}
				}
				else
				{
					DB::query("UPDATE {shop_category} SET [name]='%h', "
						.($this->id_field == "id" ? "parent_id=%d" : "import_parent_id='%h'")
						." WHERE id=%d",
						$row["name"], $row["parent_id"], $cats[$row["id"]]
					);
				}
			}
			$count = intval($this->diafan->configmodules("count_cats_".$this->site["id"], "yandex_import")) + count($this->rows["cats"]);
			$this->diafan->configmodules("count_cats_".$this->site["id"], "yandex_import", 0, false, $count);
		}

		if(! empty($this->rows["goods"]))
		{
			$ids = $this->diafan->filter($this->diafan->array_column($this->rows["goods"], "id"), "sql");
			$goods = DB::query_fetch_key("SELECT id".($this->id_field != "id" ? ", ".$this->id_field : '')
				.", cat_id FROM {shop} WHERE ".$this->id_field." IN ('"
				.implode("','", $ids)."')"
				.($this->id_field != "id" ? " AND site_id=".$this->site["id"] : ''),
				$this->id_field
			);
			$brand_names = array();
			foreach($this->rows["goods"] as $row)
			{
				if($row["brand"])
				{
					$brand_names[] = $row["brand"];
				}
			}
			if($brand_names)
			{
				$brand_names = array_unique($brand_names);
				$brands = DB::query_fetch_key_value("SELECT id, [name] FROM {shop_brand} WHERE [name] IN ('%h'".str_repeat(",'%h'", count($brand_names) - 1).")", $brand_names, "name", "id");
				foreach($brand_names as $brand)
				{
					if(empty($brands[$brand]))
					{
						$brands[$brand] = DB::query("INSERT INTO {shop_brand} ([name], site_id) VALUES ('%h', %d)", $brand, $this->site["id"]);
					}
				}
			}

			foreach($this->rows["goods"] as $row)
			{
				$row["brand_id"] = (! empty($brands[$row["brand"]]) ? $brands[$row["brand"]] : 0);
				$param_values = array();
				if(! isset($goods[$row["id"]]))
				{
					$id = DB::query("INSERT INTO {shop} (".$this->id_field.", "
					.($this->id_field == "id" ? 'cat_id' : 'import_cat_id')
					.", [name], yandex, [text], weight, length, width, height, site_id, article, brand_id, `import`) VALUES (".($this->id_field == "id" ? '%d, %d' : "'%h', '%h'")
					.", '%h', '%s', '%s', %d, %d, %d, %d, %d, '%h', %d, '1')",
					$row["id"], $row["cat_id"], $row["name"], $row["yandex"], $row["text"], $row["weight"], $row["length"], $row["width"], $row["height"], $this->site["id"], $row["article"], $row["brand_id"]);

					$cat_id = 0;
					if($this->id_field == "id")
					{
						DB::query("INSERT INTO {shop_category_rel} (cat_id, element_id) VALUES (%d, %d)", $row["cat_id"], $id);
						$cat_id = $row["cat_id"];
					}

					//ЧПУ
					if(ROUTE_AUTO_MODULE)
					{
						$this->diafan->_route->save('', $row["name"], $id, 'shop', 'element', $this->site["id"], $cat_id, 0);
					}
				}
				else
				{
					DB::query("UPDATE {shop} SET [name]='%h', yandex='%s', [text]='%s', weight=%d, length=%d, width=%d, height=%d, article='%h', brand_id=%d, "
						.($this->id_field == "id" ? 'cat_id=%d' : "import_cat_id='%h'")
						." WHERE id=%d",
						$row["name"], $row["yandex"], $row["text"], $row["weight"], $row["length"],
						$row["width"], $row["height"], $row["article"], $row["brand_id"], $row["cat_id"], $goods[$row["id"]]["id"]
					);
					$id = $goods[$row["id"]]["id"];

					if($this->id_field == "id" && $goods[$row["id"]]["cat_id"] != $row["cat_id"])
					{
						DB::query("UPDATE {shop_category_rel} SET cat_id=%d WHERE element_id=%d AND cat_id=%d", $row["cat_id"], $id, $goods[$row["id"]]["cat_id"]);
					}
					$param_values = DB::query_fetch_key_array("SELECT id, param_id, [value] FROM {shop_param_element} WHERE element_id=%d", $id, "param_id");
				}
				$this->diafan->_shop->price_insert($id, $row["price"], $row["old_price"], $row["count"], array(), 0, $id);
				
				foreach($row["imgs"] as $i => $img)
				{
					try
					{
						$iv = explode('/', $img);
						$new_name = array_pop($iv);
						$this->diafan->_images->upload($id, 'shop', 'element', $this->site['id'], $img, $new_name);
					}
					catch(Exception $e)
					{
						//echo $e->getMessage();
					}
				}
				foreach($row["param"] as $p)
				{
					if(! isset($params[$p["name"]]))
					{
						if($params[$p["name"]] = DB::query_fetch_array("SELECT id, type FROM {shop_param} WHERE ".$this->param_name."='%h'", $p["name"]))
						{
							$params[$p["name"]]["cats"] = DB::query_fetch_value("SELECT cat_id FROM {shop_param_category_rel} WHERE element_id=%d", $params[$p["name"]]["id"], "cat_id");

							if(in_array($params[$p["name"]]["type"], array('select', 'multiple')))
							{
								$params[$p["name"]]["select"] = DB::query_fetch_key_value("SELECT id, [name] FROM {shop_param_select} WHERE param_id=%d", $params[$p["name"]]["id"], "name", "id");
							}
							if($params[$p["name"]]["type"] == 'checkbox')
							{
								$params[$p["name"]]["true"] = DB::query_result("SELECT [name] FROM {shop_param_select} WHERE param_id=%d AND value='1'", $params[$p["name"]]["id"]);
							}
						}
						else
						{
							$p["value"] = trim($p["value"]);
							if(preg_match('/^[0-9\.\,]+$/', $p["value"]))
							{
								$type = 'numtext';
								$p["value"] = str_replace(',', '.', $p["value"]);
							}
							else
							{
								$type = 'text';
							}
							$params[$p["name"]]["id"] = DB::query("INSERT INTO {shop_param} (yandex_use, [name], yandex_name, yandex_unit, [measure_unit], `type`) VALUES ('1', '%h', '%h', '%h', '%h', '%s')", $p["name"], $p["name"], $p["unit"], $p["unit"], $type);
							$params[$p["name"]]["type"] = 'text';
						}
					}
					if(isset($param_values[$params[$p["name"]]["id"]]))
					{
						$vs = $param_values[$params[$p["name"]]["id"]];
						foreach($vs as $v)
						{
							if($p["value"] == $v["value"])
							{
								continue 2;
							}
						}
						if($params[$p["name"]]["type"] == "checkbox")
						{
							$p["value"] = ($p["value"] == $params[$p["name"]]["true"] || $p["value"] == 'true' || $p["value"] == 'да' || $p["value"] == 'есть' ? 1 : 0);
							if($p["value"] != $vs[0]["value"])
							{
								DB::query("UPDATE {shop_param_element} SET [value]='%d' WHERE id=%d", $p["value"], $vs[0]["id"]);
							}
						}
						elseif($params[$p["name"]]["type"] == "select")
						{
							if(! $p["value"])
							{
								DB::query("DELETE FROM {shop_param_element} WHERE id=%d", $vs[0]["id"]);
								continue;
							}
							if(! empty($params[$p["name"]]["select"][$p["value"]]))
							{
								$params[$p["name"]]["select"][$p["value"]] = DB::query("INSERT INTO {shop_param_select} (param_id, [name]) VALUES (%d, '%h')", $p["id"], $p["value"]);
							}
							$p["value"] = $params[$p["name"]]["select"][$p["value"]];

							if($p["value"] != $vs[0]["value"])
							{
								DB::query("UPDATE {shop_param_element} SET [value]='%d' WHERE id=%d", $p["value"], $vs[0]["id"]);
							}
						}
						elseif($params[$p["name"]]["type"] == "multiple")
						{
							if(! empty($params[$p["name"]]["select"][$p["value"]]))
							{
								$params[$p["name"]]["select"][$p["value"]] = DB::query("INSERT INTO {shop_param_select} (param_id, [name]) VALUES (%d, '%h')", $p["id"], $p["value"]);
							}
							$p["value"] = $params[$p["name"]]["select"][$p["value"]];

							foreach($vs as $v)
							{
								if($p["value"] == $v["value"])
								{
									continue 2;
								}
							}

							DB::query("INSERT INTO {shop_param_element} ([value], param_id, element_id) VALUES ('%d', %d, %d)", $p["value"], $params[$p["name"]]["id"], $id);
						}
					}
					elseif($p["value"])
					{
						DB::query("INSERT INTO {shop_param_element} ([value], param_id, element_id) VALUES ('%s', %d, %d)", $p["value"], $params[$p["name"]]["id"], $id);
					}
					if($this->id_field == 'id')
					{
						$cat_id = $row["cat_id"];
					}
					else
					{
						$cat_id = 0;
					}
					if(isset($params[$p["name"]]["cats"]) && (in_array($cat_id, $params[$p["name"]]["cats"]) || in_array(0, $params[$p["name"]]["cats"])))
					{
						continue;
					}
					DB::query("INSERT INTO {shop_param_category_rel} (element_id, cat_id) VALUES (%d, %d)", $params[$p["name"]]["id"], $cat_id);
				}
			}
			$count = intval($this->diafan->configmodules("count_goods_".$this->site["id"], "yandex_import")) + count($this->rows["goods"]);
			$this->diafan->configmodules("count_goods_".$this->site["id"], "yandex_import", 0, false, $count);
		}
	}

	private function finish()
	{
		$start_i = $this->diafan->filter($_GET, "integer", "start");

		if(! $start_i)
		{
			if($this->id_field != "id")
			{
				// если задано поле "Родитель" у категорий
				$rows = DB::query_fetch_all("SELECT id, import_parent_id, parent_id FROM {shop_category} WHERE `import`='1' AND site_id=%d", $this->site["id"]);
				if(! $rows)
				{
					return $start_i+1;
				}

				$import_ids = $this->diafan->filter(array_unique($this->diafan->array_column($rows, "import_parent_id")), "sql");

				$ps = DB::query_fetch_key_value("SELECT id, import_id FROM {shop_category} WHERE import_id IN ('"
					.implode("','", $import_ids)."') AND site_id=%d", $this->site["id"], "import_id", "id");

				foreach ($rows as $row)
				{
					if($row["parent_id"])
					{
						// удаляем всех старых родителей
						DB::query("DELETE FROM {shop_category_parents} WHERE element_id=%d", $row["id"]);
					}
					if ($row["import_parent_id"] && ! empty($ps[$row["import_parent_id"]]))
					{
						$row["parent_id"] = $ps[$row["import_parent_id"]];
						DB::query("UPDATE {shop_category} SET parent_id=%d WHERE id=%d", $row["parent_id"], $row["id"]);
					}
					if($row["parent_id"])
					{
						$parent_id = $row["parent_id"];
						$parents = array();
						while ($parent_id > 0 && ! in_array($parent_id, $parents))
						{
							$parents[] = $parent_id;
							DB::query("INSERT INTO {shop_category_parents} (`element_id`, `parent_id`) VALUES (%d, %d)", $row["id"], $parent_id);
							$parent_id = DB::query_result("SELECT parent_id FROM {shop_category} WHERE id=%d LIMIT 1", $parent_id);
						}
					}
				}
				DB::query("ALTER TABLE {shop_category} DROP `import_parent_id`");
			}
			else
			{
				$rows = DB::query_fetch_all("SELECT id, parent_id FROM {shop_category} WHERE `import`='1' AND site_id=%d AND parent_id!=0", $this->site["id"]);
				if(! $rows)
				{
					return $start_i+1;
				}

				$ids = $this->diafan->array_column($rows, "id");

				// удаляем всех старых родителей
				DB::query("DELETE FROM {shop_category_parents} WHERE element_id IN (%s)", implode(',', $ids));
				foreach($rows as $row)
				{
					$parent_id = $row["parent_id"];
					$parents = array();
					while ($parent_id > 0 && ! in_array($parent_id, $parents))
					{
						$parents[] = $parent_id;
						DB::query("INSERT INTO {shop_category_parents} (`element_id`, `parent_id`) VALUES (%d, %d)", $row["id"], $parent_id);
						$parent_id = DB::query_result("SELECT parent_id FROM {shop_category} WHERE id=%d LIMIT 1", $parent_id);
					}
				}
			}
			return $start_i+1;
		}
		if($start_i == 1)
		{
			// пересчитываем количество детей у всех категорий
			$rows = DB::query_fetch_all("SELECT id FROM {shop_category} WHERE site_id=%d", $this->site["id"]);
			foreach ($rows as $row)
			{
				$count = DB::query_result("SELECT COUNT(*) FROM  {shop_category_parents} WHERE parent_id=%d", $row["id"]);
				DB::query("UPDATE {shop_category} SET count_children=%d WHERE id=%d", $count, $row["id"]);
			}
			return $start_i+1;
		}
		if($start_i == 2)
		{
			DB::query("UPDATE {shop} SET sort=id WHERE sort=0");
			DB::query("UPDATE {shop_category} SET sort=id WHERE sort=0");
			return $start_i+1;
		}
		if($start_i == 3)
		{
			if($this->id_field != "id")
			{
				// если задано поле "Родитель" у категорий
				$rows = DB::query_fetch_all("SELECT id, import_cat_id FROM {shop} WHERE `import`='1' AND site_id=%d LIMIT ".(($start_i - 3) * 200).", 200", $this->site["id"]);
				if(! $rows)
				{
					DB::query("ALTER TABLE {shop} DROP `import_cat_id`");
					return;
				}

				$ids = $this->diafan->array_column($rows, "id");

				$import_ids = $this->diafan->filter(array_unique($this->diafan->array_column($rows, "import_cat_id")), "sql");

				$ps = DB::query_fetch_key_value("SELECT id, import_id FROM {shop_category} WHERE import_id IN ('"
					.implode("','", $import_ids)."') AND site_id=%d", $this->site["id"], "import_id", "id");

				$rows_cats = DB::query_fetch_all("SELECT cat_id, element_id FROM {shop_category_rel} WHERE element_id IN ('"
					.implode("','", $ids)."')");
				foreach($rows_cats as $r)
				{
					$cats[$row["element_id"]][] = $row["cat_id"];
				}

				foreach ($rows as $row)
				{
					if ($row["import_cat_id"] && ! empty($ps[$row["import_cat_id"]]))
					{
						DB::query("UPDATE {shop} SET cat_id=%d WHERE id=%d", $ps[$row["import_cat_id"]], $row["id"]);
						if(empty($cats[$row["id"]]) || ! in_array($ps[$row["import_cat_id"]], $cats[$row["id"]]))
						{
							DB::query("INSERT INTO {shop_category_rel} (cat_id, element_id) VALUES (%d, %d)", $ps[$row["import_cat_id"]], $row["id"]);
						}
					}
				}
				return $start_i+1;
			}
			return;
		}
	}

	private function fast($url)
	{
		$this->diafan->fast_request($url);
		//echo '<p><a href="'.$url.'">'.$url.'</a></p>';
		//$this->diafan->redirect_js($url);
		//exit;
	}
}

$class = new Shop_ymlimport($this->diafan);
$class->init();
exit;
