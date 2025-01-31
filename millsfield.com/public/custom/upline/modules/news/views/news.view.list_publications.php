<?php
/**
 * Шаблон список новостей
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
echo '<section class="articles-v2 section-mg65">
		<div class="articles-v2__inner">';
		
		//вывод списка новостей
		if(! empty($result["rows"]))
		{
			echo $this->get($result["view_rows"], 'news', $result);
		}

echo '</div>
	</section>';
//вывод постраничная навигация в конце списка новостей
if(! empty($result["paginator"]))
{
	echo $result["paginator"];
}

//вывод ссылок на предыдущую и последующую категории
//echo $this->htmleditor('<insert name="show_previous_next" module="news">');

//вывод комментариев к категориям, если они подключены в настройках
//if(! empty($result["comments"]))
//{
//	echo $result["comments"];
//}
