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
echo '<div class="fashion_colors v' . count($result["rows"]) . '">';
//фотографии
foreach ($result["rows"] as $row)
{
	echo '<div class="fashion_colors--item">';

	//изображение
	if (! empty($row["img"]))
	{
        echo '<a href="'.BASE_PATH.$row["img"]["vs"]["large"].'" data-fancybox="gallery-photo-block">';
		echo '<img width="" height="" src="'.$row["img"]["src"].'" " alt="'.$row["img"]["alt"].'" title="'.$row["img"]["title"].'" class="fashion_colors--item--image" loading="lazy">';
		echo '</a>';
	}
    echo '</div>';
}
echo '</div>';