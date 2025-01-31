<?php
/**
 * Выгрузка товаров в формате YML
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
 * Shop_yml
 *
 * Импорт товаров в Яндекс.Маркет
 */
class Shop_yml extends Diafan
{
	/**
	 * @var integer время последнего редактирования магазина
	 */
	private $timeedit;

	/**
	 * @var array страницы сайта, к которым прикреплен модуль Магазин
	 */
	private $sites = array();

	/**
	 * @var integer максимальное количество товаров, выгружаемых за одну итерацию
	 */
	private $max = 200;

	/**
	 * @var integer текущая итеграция цикла генерирования
	 */
	private $page = 0;

	/**
	 * Инициирует создание YML файла
	 *
	 * @return void
	 */
	public function init()
	{
		$rows = DB::query_fetch_all("SELECT id FROM {site} WHERE trash='0' AND [act]='1' AND module_name='shop' AND access='0'");
		foreach ($rows as $row)
		{
			if($this->diafan->configmodules('yandex', 'shop', $row["id"]))
			{
				$this->sites[] = $row["id"];
			}
		}
		if (! $this->sites)
		{
			Custom::inc('includes/404.php');
		}

		if(empty($_GET["rewrite"]))
		{
			if(file_exists(ABSOLUTE_PATH.'tmp/yml/yml.xml'))
			{
				if (ob_get_level())
				{
				  	ob_end_clean();
				}
				header('Content-type: application/xml; charset=utf-8');
				readfile(ABSOLUTE_PATH.'tmp/yml/yml.xml');
				return;
			}
			$_GET["rewrite"] = 'generate';
		}
		if($_GET["rewrite"] == 'generate')
		{
			File::delete_file('tmp/yml/yml_tmp.xml');
			File::delete_file('tmp/yml/yml.xml');
			$this->diafan->fast_request(BASE_PATH.'shop/yml/generate/0/?time='.time());
			$this->diafan->redirect_js(BASE_PATH.'shop/yml/wait/?time='.time());
		}
		if($_GET["rewrite"] == 'wait')
		{
			for($i = 0; $i < 200; $i++)
			{
				if(file_exists(ABSOLUTE_PATH.'tmp/yml/yml.xml'))
				{
					$this->diafan->redirect_js(BASE_PATH.'shop/yml/?time='.time());
				}
				sleep(1);
			}
			throw new Exception($this->diafan->_('Файл не успел сгенерироваться. Обновите страницу через несколько минут.'));
			return;
		}
		if(! preg_match('/generate\/([0-9]+)$/', $_GET["rewrite"], $m))
		{
			Custom::inc('includes/404.php');
		}
		if(! $m[1])
		{
			File::create_dir('tmp/yml', true);

			$text = '<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE yml_catalog SYSTEM "shops.dtd">
<yml_catalog date="'.date("Y-m-d H:i", $this->timeedit).'">
<shop>';
			$text .= $this->get_info();
			$text .= $this->get_categories();
			$text .= '
				<offers>';
			File::save_file($text, 'tmp/yml/yml_tmp.xml');
			if(! file_exists(ABSOLUTE_PATH.'tmp/yml/yml_tmp.xml'))
			{
				throw new Exception($this->diafan->_('Файл tmp/yml/yml_tmp.xml не доступен для записи.'));
				exit;
			}
			return $this->diafan->fast_request(BASE_PATH.'shop/yml/generate/'.($m[1]+1).'/?time='.time());
		}

		$text = $this->get_offers($m[1]);

		if(! $text)
		{
			$text = '
				</offers>
				</shop>
			</yml_catalog>';
			File::save_file($text, 'tmp/yml/yml_tmp.xml', 0);

			File::rename_file('yml.xml', 'yml_tmp.xml', 'tmp/yml');
			return;
		}

		File::save_file($text, 'tmp/yml/yml_tmp.xml', 0);
		$this->diafan->fast_request(BASE_PATH.'shop/yml/generate/'.($m[1]+1).'/?time='.time());
	}

	/**
	 * Генерирует часть YML-файла, содеражащую информацию о магазине
	 *
	 * @return string
	 */
	private function get_info()
	{
		$text = '
			<name>'.$this->prepare($this->diafan->configmodules('nameshop', 'shop', $this->sites[0])).'</name>
			<company>'.$this->prepare(TITLE).'</company>
			<url>'.BASE_PATH.'</url>
			<currencies>
			<currency id="';
			if ($this->diafan->configmodules('currencyyandex', 'shop', $this->sites[0]))
			{
				$text .= $this->prepare($this->diafan->configmodules('currencyyandex', 'shop', $this->sites[0]));
			}
			else
			{
				$text .= 'RUR';
			}

			$text .= '" rate="1" />
			</currencies>';
		return $text;
	}

	/**
	 * Генерирует часть YML-файла, содеражащую информацию о категориях магазина
	 *
	 * @return string
	 */
	private function get_categories()
	{
		$text = '';
		foreach ($this->sites as $site_id)
		{
			if ($this->diafan->configmodules('cat', 'shop', $site_id))
			{
				$rows = DB::query_fetch_all("SELECT id, [name], parent_id, timeedit FROM {shop_category} WHERE [act]='1' AND trash='0' AND site_id=%d"
							.($this->diafan->configmodules('show_yandex_category', 'shop', $site_id) ? " AND show_yandex='1'" : ""), $site_id);
				foreach ($rows as $row)
				{
					if (DB::query_result("SELECT [act] FROM {shop_category} WHERE id=%d LIMIT 1", $row["parent_id"])=='0')
					{
						$row["parent_id"]='0';
					}
						$text .= '
						<category id="'.$row["id"].($row["parent_id"] ? '" parentId="'.$row["parent_id"] : '').'">'
						.$this->prepare($row["name"]).'</category>';
						$this->timeedit = $row["timeedit"] > $this->timeedit ? $row["timeedit"] : $this->timeedit;
				}
			}
		}
		if($text)
		{
				$text = '
				<categories>'.$text.'
				</categories>';
		}
		return $text;
	}

	/**
	 * Генерирует часть YML-файла, содеражащую информацию о товарах магазина
	 *
	 * @return string
	 */
	private function get_offers($page)
	{
		$params = DB::query_fetch_key("SELECT id, yandex_name, yandex_unit, [name], type FROM {shop_param} WHERE yandex_use='1' AND trash='0'", "id");
		if($params)
		{
			foreach($params as $p)
			{
				if($p["type"] == 'select' || $p["type"] == 'multiple')
				{
					$pselectid[] = $p["id"];
				}
			}
			if(! empty($pselectid))
			{
				$pselect = DB::query_fetch_key_value("SELECT id, [name] FROM {shop_param_select} WHERE param_id IN (%s)", implode(',', $pselectid), "id", "name");
			}
		}

		$site_where = array();
		foreach ($this->sites as $site_id)
		{
			$q = "s.site_id=".$site_id;
			if($this->diafan->configmodules('show_yandex_element', 'shop', $site_id))
			{
				$q .= " AND s.show_yandex='1'";
			}
			if ($this->diafan->configmodules('cat', 'shop', $site_id) && $this->diafan->configmodules('show_yandex_category', 'shop', $site_id))
			{
				$q .= " AND c.show_yandex='1'";
			}
			$site_where[] = $q;
		}

		$query = "SELECT s.* FROM {shop} AS s";
		$query .= " INNER JOIN {shop_category} AS c ON c.id=s.cat_id";
		$query .= " WHERE s.[act]='1' AND s.trash='0' AND (".implode(" OR ", $site_where).")";
		$query .= " AND c.[act]='1' AND c.trash='0'";

		$rows = DB::query_range_fetch_all($query, ($page - 1) * $this->max, $this->max);
		if(! $rows)
		{
			return false;
		}
		foreach ($rows as $row)
		{
			$this->diafan->_shop->price_prepare_all($row["id"]);
			$this->diafan->_route->prepare($row["site_id"], $row["id"], "shop");
		}
		$ids = $this->diafan->array_column($rows, "id");

		$images = DB::query_fetch_key_array("SELECT id, name, folder_num, element_id FROM {images} WHERE module_name='shop' AND element_type='element' AND trash='0' AND element_id IN (%s) ORDER BY sort ASC", implode(',', $ids), "element_id");
		if($params)
		{
			$pvs = DB::query_fetch_all("SELECT id, [value], param_id, element_id FROM {shop_param_element} WHERE element_id IN (%s) AND param_id IN (%s)", implode(',', $ids), implode(',', array_keys($params)));
			foreach($pvs as $p)
			{
				$pid = $p["id"];
				if($params[$p["param_id"]]["type"] == 'select' || $params[$p["param_id"]]["type"] == 'multiple')
				{
					$pid = $p["value"];
					$p["value"] = ! empty($pselect[$p["value"]]) ? $pselect[$p["value"]] : '';
				}
				if(! $p["value"])
				{
					continue;
				}
				$params_value[$p["param_id"]][$p["element_id"]][$pid] = array("id" => $pid, "value" => $p["value"]);
			}
		}

		$text = '';
		foreach ($rows as $row)
		{
			if(! isset($this->cache["shop_images_variation_medium"][$row["site_id"]]))
			{
				$this->cache["shop_images_variation_medium"][$row["site_id"]] = '';
				$images_variations = unserialize($this->diafan->configmodules("images_variations_element", 'shop', $row["site_id"]));
				if(isset($images_variations["vs"]))
				{
					$images_variations = $images_variations["vs"];
				}
				foreach ($images_variations as $images_variation)
				{
					if($images_variation["name"] == 'medium')
					{
						$this->cache["shop_images_variation_medium"][$row["site_id"]] = DB::query_result("SELECT folder FROM {images_variations} WHERE id=%d LIMIT 1", $images_variation["id"]);
						continue;
					}
				}
			}
			$shop_images_variation_medium = $this->cache["shop_images_variation_medium"][$row["site_id"]];
			
			$yandex = array();
			$link = BASE_PATH.$this->diafan->_route->link($row["site_id"], $row["id"], "shop");
			$this->timeedit = $row["timeedit"] > $this->timeedit ? $row["timeedit"] : $this->timeedit;

			if ($row["yandex"])
			{
				$y_arr = explode("\n", $this->prepare($row["yandex"]));
				foreach ($y_arr as $y_a)
				{
					list($k, $v) = explode("=", $y_a, 2);
					$yandex[$k] = $v;
				}
			}
			if (empty($yandex["vendor"]) && ! empty($row["brand_id"]))
			{
				$yandex["vendor"] = DB::query_result("SELECT [name] FROM {shop_brand} WHERE id=%d", $row["brand_id"]);
				$yandex["vendor"] = htmlspecialchars($yandex["vendor"], ENT_NOQUOTES);
			}
			if($prices = $this->diafan->_shop->price_get_all($row["id"], 0))
			{
				foreach($prices as $p_i => $dummy)
				{
					$prices[$p_i]["price_param"] = DB::query_fetch_key_value("SELECT param_id, param_value FROM {shop_price_param} WHERE price_id=%d AND trash='0'", $prices[$p_i]["id"], "param_id", "param_value");
				}
			}

			if(empty($prices) || $this->diafan->configmodules("use_count_goods", 'shop', $row["site_id"]) && ! $prices[0]["count_goods"] || $row["no_buy"])
			{
				$available = 'false';
			}
			else
			{
				$available = 'true';
			}

			$imgs = ! empty($images[$row["id"]]) ? $images[$row["id"]] : array();

			$pictures = array();
			foreach($imgs as $img)
			{
				$pictures[] = BASE_PATH.USERFILES.'/shop/'.$shop_images_variation_medium.'/'.($img["folder_num"] ? $img["folder_num"].'/' : '').$img["name"];
			}

			$bid = ! empty($yandex["bid"]) ? $yandex["bid"] : $this->diafan->configmodules('bid', 'shop', $row["site_id"]);

			if (! empty($prices) AND $available == 'true')
			{
				$group_id = count($prices) > 1 ? $row["id"] : false;
				foreach($prices as $p_i => $dummy)
				{
					$oldprice = 0;
					if($prices[$p_i]["price"] * 100 % 100) $price = number_format($prices[$p_i]["price"], 2, '.', '');
					else $price = number_format($prices[$p_i]["price"], 0, '.', '');
					if($prices[$p_i]["old_price"] && $prices[$p_i]["old_price"] != $prices[$p_i]["price"])
					{
						if($prices[$p_i]["old_price"] * 100 % 100) $oldprice = number_format($prices[$p_i]["old_price"], 2, '.', '');
						else $oldprice = number_format($prices[$p_i]["old_price"], 0, '.', '');
					}

					if (empty($yandex["typePrefix"]) || empty($yandex["vendor"]) || empty($yandex["vendorCode"]) || empty($yandex["model"]))
					{
						$text .= '
						<offer id="'.base_convert($row["id"], 10, 35).'z'.base_convert(($p_i+1), 10, 35).'" available="'.$available.'"'.($bid ? ' bid="'.$bid.'"' : '').($group_id !== false ? ' group_id="'.$group_id.'"' : '').'>
							<url>'.$link.'</url>
							<price>'.$price.'</price>';
							if($oldprice)
							{
								$text .= '
								<oldprice>'.$oldprice.'</oldprice>';
							}
							$text .= '
							<currencyId>';
							if ($this->diafan->configmodules('currencyyandex', 'shop', $row["site_id"]))
							{
								$text .= $this->prepare($this->diafan->configmodules('currencyyandex', 'shop', $row["site_id"]));
							}
							else
							{
								$text .= 'RUR';
							}
						$text .= '</currencyId>';
						if ($this->diafan->configmodules('cat', 'shop', $row["site_id"]))
						{
							$text .= '
							<categoryId>'.$row["cat_id"].'</categoryId >';
						}
						$showpictures=0;
						foreach ($pictures as $picture)
						{
							if ($showpictures<10) { $text .= '
							<picture>'.$picture.'</picture>'; }
							$showpictures++;
						}
						$text .= '
							<delivery>true</delivery>
							<name>'.$this->prepare($row["name".$this->diafan->_languages->site]).'</name>';
						if (! empty($yandex["model"]))
						{
							$text .= '
								<model>'.$yandex["model"].'</model>';
						}
						if (! empty($yandex["vendor"]))
						{
							$text .= '
							<vendor>'.$yandex["vendor"].'</vendor>';
						}
						if (! empty($yandex["vendorCode"]))
						{
							$text .= '
							<vendorCode>'.$yandex["vendorCode"].'</vendorCode>';
						}
						if (! empty($row["weight"]))
						{
							if($this->diafan->configmodules('weight_unit', 'shop', $row["site_id"]) == "g")
							{
								$text .= '
							 <weight>'.((int)($row["weight"])/1000).'</weight>';
							}
							else
							{
								$text .= '
							 <weight>'.$row["weight"].'</weight>';
							}
							
						}
						if (! empty($row["length"]) AND ! empty($row["width"]) AND ! empty($row["height"]))
						{
							$text .= '
							 <dimensions>'.((int)($row["length"])/10).'/'.((int)($row["width"])/10).'/'.((int)($row["height"])/10).'</dimensions>';
						}
						if (! empty($yandex["sales_notes"]))
						{
							$text .= '
							<sales_notes>'.$yandex["sales_notes"].'</sales_notes>';
						}
						if ($row["text".$this->diafan->_languages->site])
						{
							$text .= '
							<description><![CDATA[
							'.$this->prepare($row["text".$this->diafan->_languages->site]).'
							]]></description>';
						}
						$text .= '
							<manufacturer_warranty>'.(! empty($yandex["manufacturer_warranty"]) ? 'true' : 'false').'</manufacturer_warranty>';
						if (! empty($yandex["country_of_origin"]))
						{
							$text .= '
							<country_of_origin>'.$yandex["country_of_origin"].'</country_of_origin>';
						}
					}
					else
					{
						$text .= '
						<offer id="'.$row["id"].'" type="vendor.model" available="'.$available.'"'.($bid ? ' bid="'.$bid.'"' : '').'>
							<url>'.$link.'</url>
							<price>'.$price.'</price>';
							if($oldprice)
							{
								$text .= '<oldprice>'.$oldprice.'</oldprice>';
							}
							$text .= '<currencyId>';
							if ($this->diafan->configmodules('currencyyandex', 'shop', $row["site_id"]))
							{
								$text .= $this->prepare($this->diafan->configmodules('currencyyandex', 'shop', $row["site_id"]));
							}
							else
							{
								$text .= 'RUR';
							}
						$text .= '</currencyId>';
						if ($this->diafan->configmodules('cat', 'shop', $row["site_id"]))
						{
							$text .= '
							<categoryId>'.$row["cat_id"].'</categoryId >';
						}
						$showpictures=0;
						foreach ($pictures as $picture)
						{
							if ($showpictures<10) { $text .= '
							<picture>'.$picture.'</picture>'; }
							$showpictures++;
						}
						$text .= '
							<delivery>true</delivery>';
						$text .= '
							<typePrefix>'.$yandex["typePrefix"].'</typePrefix>
							<vendor>'.$yandex["vendor"].'</vendor>';
						if (! empty($yandex["vendorCode"]))
						{
							$text .= '
							<vendorCode>'.$yandex["vendorCode"].'</vendorCode>';
						}
						if (! empty($yandex["sales_notes"]))
						{
							$text .= '
							<sales_notes>'.$yandex["sales_notes"].'</sales_notes>';
						}
						$text .= '
							<model>'.$yandex["model"].'</model>';
						if (! empty($row["weight"]))
						{
							if($this->diafan->configmodules('weight_unit', 'shop', $row["site_id"]) == "g")
							{
								$weight = (int)($row["weight"])/1000;
							}
							else
							{
								$weight = (int)($row["weight"]);
							}
								$text .= '
							 <weight>'.$weight.'</weight>';
						}
						if (! empty($row["length"]) AND ! empty($row["width"]) AND ! empty($row["height"]))
						{
							$text .= '
							 <dimensions>'.((int)($row["length"])/10).'/'.((int)($row["width"])/10).'/'.((int)($row["height"])/10).'</dimensions>';
						}
						if ($row["text".$this->diafan->_languages->site])
						{
							$text .= '
							<description><![CDATA[
							'.$this->prepare($row["text".$this->diafan->_languages->site]).'
							]]></description>';
						}
						$text .= '
							<manufacturer_warranty>'.(! empty($yandex["manufacturer_warranty"]) ? 'true' : 'false').'</manufacturer_warranty>';
						if (! empty($yandex["country_of_origin"]))
						{
							$text .= '
							<country_of_origin>'.$yandex["country_of_origin"].'</country_of_origin>';
						}
					}
					if($params)
					{
						foreach($params AS $p)
						{
							if($p["type"] == 'checkbox')
							{
								if(! empty($params_value[$p["id"]][$row["id"]]))
								{
									$text .= '
							<param name="'.($p["yandex_name"] ? $p["yandex_name"] : $p["name"]).'"'
									.($p["yandex_unit"] ? ' unit="'.$p["yandex_unit"].'"' : '').'>есть</param>';
								}
							}
							elseif(! empty($params_value[$p["id"]][$row["id"]]))
							{
								if(! empty($prices[$p_i]["price_param"])
								&& array_key_exists($p["id"], $prices[$p_i]["price_param"]))
								{
									$price_param_value = $prices[$p_i]["price_param"][$p["id"]];
								} else $price_param_value = false;
								foreach($params_value[$p["id"]][$row["id"]] as $v)
								{
									if($price_param_value !== false
									&& $price_param_value != $v["id"]) {
										continue;
									}
									$text .= '
							<param name="'.($p["yandex_name"] ? $p["yandex_name"] : $p["name"]).'"'
									.($p["yandex_unit"] ? ' unit="'.$p["yandex_unit"].'"' : '').'>'.$v["value"].'</param>';
								}
							}
						}
					}
					$text .= '
						</offer>';
				}
			}
		}
		return $text;
	}

	/**
	 * Подготавливает текст для отображения в YML-файле
	 *
	 * @param string $text исходный текст
	 * @return string
	 */
	private function prepare($text)
	{
		$repl = array('&nbsp;', '"','&','>','<',"'", chr(0), chr(1), chr(2), chr(3), chr(4),
			      chr(5), chr(6), chr(7), chr(8), chr(11), chr(12), chr(14), chr(15),
			      chr(16), chr(17), chr(18), chr(19), chr(20), chr(21), chr(22), chr(23),
			      chr(24), chr(25), chr(26), chr(27), chr(28), chr(29), chr(30), chr(31));
		$replm = array(' ', '&quot;', '&amp;', '&gt;', '&lt;', '&apos;', '', '', '', '', '',
			       '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '',
			       '', '', '', '', '', '');

		$text = str_replace($repl, $replm, strip_tags($text));
		return $text;
	}
}

$class = new Shop_yml($this->diafan);
$class->init();
exit;
