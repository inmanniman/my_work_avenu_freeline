<?php
/**
 * Шаблон блока фотографий
 * 
 * Шаблонный тег <insert name="show_block" module="photo" [count="количество"]
 * [cat_id="категория"] [site_id="страница_с_прикрепленным_модулем"]
 * [sort="порядок_вывода"] 
 * [images_variation="тег_размера_изображений"]
 * [only_module="only_on_module_page"] [template="шаблон"]>:
 * блок фотографий
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



if(empty($result["rows"])) return false;

echo '<section class="block-d block-d_photo block-d_photo_item">';

//заголовок блока
if (! empty($result['name']))
{
	echo '<header class="block-d__name">'.$result['name'].'</header>';
}

//фотографии
echo '<div class="block-d__list _list">';
echo $this->get($result['view_rows'], 'photo', $result);
echo '</div>';

echo '</section>';