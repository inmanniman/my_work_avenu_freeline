<?php
/**
 * Шаблон блока новостей
 * 
 * Шаблонный тег <insert name="show_block" module="news" [count="количество"]
 * [cat_id="категория"] [site_id="страница_с_прикрепленным_модулем"]
 * [images="количество_изображений"] [images_variation="тег_размера_изображений"]
 * [only_module="only_on_module_page"] [template="шаблон"]>:
 * блок новостей
 * 
 * @package    DIAFAN.CMS
 * @author     diafan.ru
 * @version    6.0
 * @license    http://www.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2018 OOO «Диафан» (http://www.diafan.ru/)
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

if(empty($result["rows"])) return false;


//заголовок блока
echo '<div class="news-head">';
if (! empty($result["name"]))
{
	echo '<h2 class="news-title">'.$result["name"].'</h2>';
}
echo '<div class="news-btn-wrap"><a href="', $this->diafan->_route->link(177), '" class="news-btn">Смотреть <br>больше новостей</a></div>';
echo '</div>';
//новости
echo '<div class="news-grid">';
echo $this->get($result["view_rows"].'_home', 'news', $result);
echo '</div>';