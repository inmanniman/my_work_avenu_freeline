<?php
/**
 * Подключение модуля
 *
 * @package    DIAFAN.CMS
 * @author     diafan.ru
 * @version    7.0
 * @license    http://www.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2021 OOO «Диафан» (http://www.diafan.ru/)
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
 * Map_inc
 */
class Map_inc extends Model
{
	/**
	 * @var array языковые версии сайта
	 */
	private $lang;

	/**
	 * @var array ЧПУ
	 */
	private $rewrites;

	/**
	 * @var string
	 */
	private $type;

	/**
	 * @var integer максимальное количество ссылок, индексируемых за один проход скрипта
	 */
	private $max_insert = 200;

	/**
	 * @var integer
	 */
	private $current_insert = 0;

	/**
	 * @var string тип данных, проиндексированный за предыдущий проход скрипта
	 */
	private $last_type = '';

	/**
	 * @var integer страница сайта, проиндексированная за предыдущий проход скрипта
	 */
	private $last_site_id = 0;

	/**
	 * Индексирует весь сайт
	 *
	 * @return void
	 */
	public function index_all()
	{
		if($this->token('all')) return;

		$this->set_languages();

		if(! $this->diafan->configmodules($this->type."_site_id", "map"))
		{
			DB::query("TRUNCATE TABLE {map_index}");
		}

		$module = $this->diafan->configmodules($this->type."_module_name", "map");

		$rows = DB::query_fetch_all(
			"SELECT * FROM {site} WHERE trash='0' AND access='0'"
			." AND map_no_show='0' AND id".($module ? '=' : '>')."%d ORDER BY id ASC"
			." LIMIT ".($module ? 1 : $this->max_insert),
			$this->diafan->configmodules($this->type."_site_id", "map")
		);
		if(! $rows)
		{
			$this->diafan->configmodules($this->type."_module_type", "map", 0, false, '');
			$this->diafan->configmodules($this->type."_element_type", "map", 0, false, '');
			$this->diafan->configmodules($this->type."_element_id", "map", 0, false, '');
			$this->diafan->configmodules($this->type."_site_id", "map", 0, false, '');
			$this->diafan->configmodules("full_index", "map", 0, false, true);
			$this->diafan->configmodules($this->type."_token", "map", 0, false, '');
			exit;
		}

		$ids = $this->diafan->array_column($rows, "id");

		$this->set_rewrites($ids, "site", "element");
		foreach ($rows as $row)
		{
			if(! $module)
			{
				foreach ($this->lang as $l)
				{
					if (! $row["act".$l["id"]])
						continue;

					if($row["id"] == 1)
					{
						$rewrite = '';
					}
					else
					{
						$rewrite = $this->get_url($row["id"], 'site', 'element', 0);
					}
					$this->insert($row["id"], 'site', 'element', $l["name"].$rewrite, $row["timeedit"], $row["changefreq"], $row["priority"], $row["date_start"], $row["date_finish"]);
				}
			}
			if(! $row["module_name"])
			{
				continue;
			}
			$this->index_site_module($row);
			$site_id = $row["id"];
		}
		$this->next($site_id);
	}

	/**
	 * Индексирует модуль
	 *
	 * @param string $module_name название модуля
	 * @return void
	 */
	public function index_module($module_name)
	{
		if($module_name == 'map')
			return;

		if(! Custom::exists('modules/'.$module_name.'/'.$module_name.'.sitemap.php')) return;

		if($this->token('module_'.$module_name)) return;

		if(! $this->diafan->configmodules($this->type."_site_id", "map"))
		{
			$this->delete_module($module_name);
		}

		$this->set_languages();

		$module = $this->diafan->configmodules($this->type."_module_name", "map");

		$rows = DB::query_fetch_all(
			"SELECT * FROM {site} WHERE trash='0' AND access='0' AND module_name='%s'"
			." AND map_no_show='0' AND id".($module ? '=' : '>')."%d ORDER BY id ASC"
			." LIMIT 1", $module_name,
			$this->diafan->configmodules($this->type."_site_id", "map")
		);
		if(! $rows)
		{
			$this->diafan->configmodules($this->type."_module_type", "map", 0, false, '');
			$this->diafan->configmodules($this->type."_element_type", "map", 0, false, '');
			$this->diafan->configmodules($this->type."_element_id", "map", 0, false, '');
			$this->diafan->configmodules($this->type."_site_id", "map", 0, false, '');
			$this->diafan->configmodules($this->type."_index", "map", 0, false, true);
			$this->diafan->configmodules($this->type."_token", "map", 0, false, '');
			exit;
		}

		foreach ($rows as $row)
		{
			$this->index_site_module($row);
			$site_id = $row["id"];
		}
		$this->next($site_id);
	}

	/**
	 * Индексирует страницы модуля, прикрепленного к странице сайта
	 *
	 * @param array $row данные о странице сайта
	 * @return void
	 */
	public function index_site_module($row)
	{
		if($row["module_name"] == 'map')
			return;

		if (empty($row["module_name"]) || ! Custom::exists('modules/'.$row["module_name"].'/'.$row["module_name"].'.sitemap.php'))
			return;

		$current_type = '';
		if($this->diafan->configmodules($this->type."_module_name", "map"))
		{
			$current_type = $this->diafan->configmodules($this->type."_element_type", "map");
		}

		Custom::inc('modules/'.$row["module_name"].'/'.$row["module_name"].'.sitemap.php');
		$class_name = ucfirst($row["module_name"]).'_sitemap';
		$class = new $class_name($this->diafan);
		if(is_callable(array(&$class, 'config')))
		{
			$config = call_user_func_array(array(&$class, 'config'), array($row["id"]));
			if(is_array($config))
			{
				if(! empty($config["type"]))
				{
					foreach($config["type"] as $type)
					{
						if($current_type && $current_type != $type)
						{
							continue;
						}
						if($current_type == $type && ! $this->diafan->configmodules($this->type."_element_id", "map"))
						{
							$current_type = '';
							continue;
						}
						$where =  ! empty($config['where'][$type]) ? $config['where'][$type] : '';

						$this->elements($row["module_name"], $type, $row["id"], $row["timeedit"], $row["changefreq"], $row["priority"], $where, true);
						return;
					}
				}
			}
		}
		$this->next($row["id"]);
		$this->diafan->configmodules("module_".$row["module_name"]."_index", "map", 0, false, true);
	}

	/**
	 * Индексирует группу элементов
	 *
	 * @param array $rows массив данных об индексируемых элементах
	 * @return void
	 */
	public function index_elements($rows)
	{
		if(! $rows)
			return;

		$this->set_languages();
		foreach ($rows as &$row)
		{
			if(empty($row["element_type"]))
			{
				$row["element_type"] = 'element';
			}
			$ids[] = $row["id"];
		}
		$this->set_rewrites($ids, $rows[0]["module_name"], $rows[0]["element_type"]);
		if(! empty($ids))
		{
			$this->delete($ids, $rows[0]["module_name"], $rows[0]["element_type"]);
		}
		foreach ($rows as &$row)
		{
			if(! empty($row["map_no_show"]))
				continue;

			$row["link"] = $this->get_url($row["id"], $row["module_name"], $row["element_type"], $row["site_id"]);
			if(empty($row["date_start"]))
			{
				$row["date_start"] = 0;
			}
			if(empty($row["date_finish"]))
			{
				$row["date_finish"] = 0;
			}
			if(! empty($row["created"]) && $row["created"] > $row["date_start"])
			{
				$row["date_start"] = $row["created"];
			}
			foreach ($this->lang as $l)
			{
				if (isset($row["act".$l["id"]]) && ! $row["act".$l["id"]] || isset($row["act"]) && empty($row["act"]))
					continue;
				$this->insert($row["id"], $row["module_name"], $row["element_type"], $l["name"].$row["link"], $row["timeedit"], $row["changefreq"], $row["priority"], $row["date_start"], $row["date_finish"]);
			}
		}
	}

	/**
	 * Индексирует один элемент
	 *
	 * @param array $row данные об индексируемом элементе
	 * @return void
	 */
	public function index_element($row)
	{
		if(empty($row["element_type"]))
		{
			$row["element_type"] = 'element';
		}

		$this->set_languages();
		$this->set_rewrites($row["id"], $row["module_name"], $row["element_type"]);

		$this->delete($row["id"], $row["module_name"], $row["element_type"]);

		if(empty($row["changefreq"]))
		{
			$row["changefreq"] = '';
		}
		if(empty($row["priority"]))
		{
			$row["priority"] = '';
		}
		if(empty($row["timeedit"]))
		{
			$row["timeedit"] = time();
		}
		if(empty($row["date_start"]))
		{
			$row["date_start"] = 0;
		}
		if(empty($row["date_finish"]))
		{
			$row["date_finish"] = 0;
		}
		if(! empty($row["created"]) && $row["created"] > $row["date_start"])
		{
			$row["date_start"] = $row["created"];
		}
		if(! $row["changefreq"] && ! $row["priority"])
		{
			if(! empty($row["cat_id"]))
			{
				$parent = DB::query_fetch_array("SELECT * FROM {%s} WHERE id=%d", $row["module_name"].'_category', $row["cat_id"]);
				if($parent)
				{
					$row["changefreq"] = (! empty($parent["changefreq"]) ? $parent["changefreq"] : '');
					$row["priority"] = (! empty($parent["priority"]) ? $parent["priority"] : '');
				}
			}
			if(empty($parent) && $row["module_name"] != 'site')
			{
				$parent = DB::query_fetch_array("SELECT changefreq, priority FROM {site} WHERE id=%d", $row["site_id"]);
				if($parent)
				{
					$row["changefreq"] = (! empty($parent["changefreq"]) ? $parent["changefreq"] : '');
					$row["priority"] = (! empty($parent["priority"]) ? $parent["priority"] : '');
				}
			}
		}

		$row["link"] = $this->get_url($row["id"], $row["module_name"], $row["element_type"], $row["site_id"]);
		

		foreach ($this->lang as $l)
		{
			if (isset($row["act".$l["id"]]) && ! $row["act".$l["id"]] || isset($row["act"]) && empty($row["act"]))
				continue;
			$this->insert($row["id"], $row["module_name"], $row["element_type"], $l["name"].$row["link"], $row["timeedit"], $row["changefreq"], $row["priority"], $row["date_start"], $row["date_finish"]);
		}
	}

	/**
	 * Удаляет один или несколько элементов из индекса
	 *
	 * @param integer|array $element_ids номер одного или нескольких элементов
	 * @param string $module_name название модуля
	 * @param string $element_type тип данных
	 * @return void
	 */
	public function delete($element_ids, $module_name, $element_type = 'element')
	{
		if(is_array($element_ids))
		{
			$where = " IN (%s)";
			$value = preg_replace('/[^0-9,]+/', '', implode(",", $element_ids));
		}
		else
		{
			$where = "=%d";
			$value = $element_ids;
		}
		DB::query("DELETE FROM {map_index} WHERE module_name='%s' AND element_type='%s' AND element_id".$where, $module_name, $element_type, $value);
	}

	/**
	 * Удаляет весь индекс модуля
	 *
	 * @param string $module_name название модуля
	 * @return void
	 */
	public function delete_module($module_name)
	{
		if(! DB::tables('map_index', true))
		{
			return;
		}
		DB::query("DELETE FROM {trash} WHERE module_name='map' AND element_id IN (SELECT id FROM {map_index} WHERE module_name='%s')", $module_name);
		DB::query("DELETE FROM {map_index} WHERE module_name LIKE '".$module_name."'");
	}

	/**
	 * Удаляет индекс модулей, прикрепленных к страницам сайта
	 *
	 * @param array $site_ids идентификаторы страниц сайта
	 * @return void
	 */
	public function delete_sites($site_ids)
	{
		$sites = DB::query_fetch_all("SELECT id, module_name FROM {site} WHERE id IN (%s)", implode(",", $site_ids));
		foreach($sites as $site)
		{
			if($site["module_name"] && $site["module_name"] != "map"
			   && Custom::exists('modules/'.$site["module_name"].'/'.$site["module_name"].'.sitemap.php'))
			{
				Custom::inc('modules/'.$site["module_name"].'/'.$site["module_name"].'.sitemap.php');
				$class_name = ucfirst($site["module_name"]).'_sitemap';
				$class = new $class_name($this->diafan);

				if(is_callable(array(&$class, 'config')))
				{
					$config = call_user_func_array(array(&$class, 'config'), array($site["id"]));
					if(empty($config["type"]))
					{
						continue;
					}
					foreach($config["type"] as $element_type)
					{
						$where =  ! empty($config['where'][$element_type]) ? $config['where'][$element_type] : '';
						$table_name = $this->diafan->table_element_type($site["module_name"], $element_type);

						$ids = DB::query_fetch_value("SELECT id FROM {%s} WHERE 1=1 ".$where, $table_name, "id");
						if($ids)
						{
							$this->delete($ids, $site["module_name"], $element_type);
						}
					}
				}
			}
		}
	}

	private function token($type)
	{
		$this->type = $type;

		if(! $this->diafan->configmodules($this->type."_token", "map"))
		{
			$token = mt_rand(0, 9999999).time();
			$this->diafan->configmodules($this->type."_token", "map", 0, false, $token);
			$this->diafan->fast_request(BASE_PATH.'map/sitemap/generate/?token='.$token.'&time='.time().'&type='.$this->type);
			return true;
		}
		return false;
	}

	/**
	 * Добавляет в базу данных элемент
	 *
	 * @param integer $element_id номер элемента
	 * @param string $module_name название модуля
	 * @param string $element_type тип данных
	 * @param string $url адрес (без домена, ЧПУ на конце)
	 * @param integer $timeedit время редактирования
	 * @param string $changefreq частота редактирования
	 * @param float $priority приоритет
	 * @param integer $date_start дата начала показа
	 * @param integer $date_finish дата окончания показа
	 * @return void
	 */
	private function insert($element_id, $module_name, $element_type, $url, $timeedit, $changefreq, $priority, $date_start, $date_finish)
	{
		DB::query("INSERT INTO {map_index} (url, module_name, element_id, element_type, timeedit, changefreq, priority, date_start, date_finish) VALUES ('%s', '%s', %d, '%s', %d, '%s', '%h', %d, %d)", $url, $module_name, $element_id, $element_type, $timeedit, ($changefreq ? $changefreq : 'always'), str_replace(',', '.', $priority), $date_start, $date_finish);

		$this->current_insert++;
	}

	/**
	 * Записываем все языки сайта
	 *
	 * @return void
	 */
	private function set_languages()
	{
		if(! empty($this->lang))
			return;

		foreach ($this->diafan->_languages->all as $row)
		{
			$this->lang[] = array("name" => (! $row["base_site"] ? $row["shortname"].'/' : ''), "id" => $row["id"]);
		}
	}

	/**
	 * Записываем все ЧПУ
	 *
	 * @param string $module_name название модуля
	 * @param integer|array $element_ids номера элементов
	 * @param string $element_type тип данных
	 * @return void
	 */
	private function set_rewrites($element_ids = array(), $module_name, $element_type)
	{
		$where = " AND module_name='".$module_name."' AND element_type='".$element_type."' AND element_id";
		if(is_array($element_ids))
		{
			$where .= " IN (".implode(",", $element_ids).")";
		}
		else
		{
			$where .= "=".$element_ids;
		}
		$rows = DB::query_fetch_all("SELECT * FROM {rewrite} WHERE trash='0'".$where);
		foreach ($rows as $row)
		{
			$this->rewrites[$row["module_name"]][$row["element_type"]][$row["element_id"]] = $row["rewrite"];
		}
	}

	/**
	 * Индексирует элементы модулей
	 *
	 * @param string $module_name название модуля
	 * @param string $element_type тип элемента
	 * @param integer $site_id страница сайта
	 * @param integer $timeedit время редактирования страницы сайта
	 * @param string $changefreq частота изменения страницы сайта
	 * @param float $priority приоритет страницы сайта
	 * @param string $where дополнительное условие отображения на сайте
	 * @param boolean $delete удалить старый индекс
	 * @return void
	 */
	private function elements($module_name, $element_type, $site_id, $timeedit, $changefreq, $priority, $where, $delete = false)
	{
		$table_name = $module_name;
		$wh = $where;
		switch($element_type)
		{
			case 'element':
				break;

			case 'param':
				$table_name .= '_param_select';
				break;

			case 'cat':
				$table_name .= '_category';
				break;

			default:
				$table_name .= '_'.$element_type;
				break;
		}
		if($module_name == 'tags')
		{
			$table_name = 'tags_name';
		}
		$rows = DB::query_fetch_all("SELECT * FROM {".$table_name."} WHERE trash='0' AND id>%d ORDER BY id ASC LIMIT ".$this->max_insert, $this->diafan->configmodules($this->type."_element_id", "map"));
		if(! $rows)
		{
			$this->next($site_id, $module_name, $element_type);
		}

		$ids = $this->diafan->array_column($rows, "id");
		
		if($delete)
		{
			$this->delete($ids, $module_name, $element_type);
		}
		$this->set_rewrites($ids, $module_name, $element_type);

		foreach ($rows as $row)
		{
			$row["link"] = $this->get_url($row["id"], $module_name, $element_type, $site_id);

			if(empty($row["date_start"]))
			{
				$row["date_start"] = 0;
			}
			if(empty($row["date_finish"]))
			{
				$row["date_finish"] = 0;
			}
			if(! empty($row["created"]) && $row["created"] > $row["date_start"])
			{
				$row["date_start"] = $row["created"];
			}
			if(! empty($row["timeedit"]) && $row["timeedit"] > $timeedit)
			{
				$timeedit = $row["timeedit"];
			}
			if(! empty($row["changefreq"]))
			{
				$changefreq = $row["changefreq"];
			}
			if(! empty($row["priority"]))
			{
				$priority = $row["priority"];
			}

			foreach ($this->lang as $l)
			{
				if (isset($row["act".$l["id"]]) && ! $row["act".$l["id"]] || isset($row["act"]) && ! $row["act"])
					continue;

				$this->insert($row["id"], $module_name, $element_type, $l["name"].$row["link"], $timeedit, $changefreq, $priority, $row["date_start"], $row["date_finish"]);
			}
			$element_id = $row["id"];
		}
		$this->next($site_id, $module_name, $element_type, $element_id);
	}

	/**
	 * Переход на следующий проход скрипта
	 *
	 * @param integer $site_id текущая страница сайта
	 * @param string $module_name текущий модуль
	 * @param string $element_type текущий тип данных
	 * @param integer $element_id номер текущего проиндексированного элемента
	 * @return void
	 */
	private function next($site_id, $module_name = '', $element_type = '', $element_id = '')
	{
		$this->diafan->configmodules($this->type."_site_id", "map", 0, false, $site_id);
		$this->diafan->configmodules($this->type."_module_name", "map", 0, false, $module_name);
		$this->diafan->configmodules($this->type."_element_type", "map", 0, false, $element_type);
		$this->diafan->configmodules($this->type."_element_id", "map", 0, false, $element_id);

		$this->diafan->fast_request(
			BASE_PATH.'map/sitemap/generate/?token='
			.$this->diafan->configmodules($this->type."_token", "map")
			.'&type='.$this->type
			.'&time='.time()
		);
		exit;
	}

	/**
	 * Формирует ссылку
	 *
	 * @param string $module_name модуль
	 * @param integer $element_id элемент
	 * @param string $element_type тип элемента
	 * @param integer $site_id страница сайта
	 * @return void
	 */
	private function get_url($element_id, $module_name, $element_type, $site_id)
	{
		if(! empty($this->rewrites[$module_name][$element_type][$element_id]))
		{
			return $this->rewrites[$module_name][$element_type][$element_id].'ROUTE_END';
		}
		elseif($module_name == 'site' && $element_id == 1)
		{
			return '';
		}
		else
		{
			if($element_type == 'element')
			{
				$element_type = 'show';
			}
			return ($this->rewrites["site"]['element'][$site_id] ? $this->rewrites["site"]['element'][$site_id].'/' : '').$element_type.$element_id.'/';
		}
	}
}