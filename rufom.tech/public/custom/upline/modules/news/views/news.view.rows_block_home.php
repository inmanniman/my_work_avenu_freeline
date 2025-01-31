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

//новости
foreach ($result["rows"] as $row)
{
	echo '<div class="item-wrap">';
	echo '<div class="item">';

	//изображения новости
	if (! empty($row["img"]))
	{
		foreach ($row["img"] as $img){
			echo '<a href="'.BASE_PATH_HREF.$row["link"].'" class="item-img">';
			echo '<img class="item-img__img" src="'.$img["src"].'" alt="'.$img["alt"].'" title="'.$img["title"].'" width="360" height="260" loading="lazy">';
			echo '</a>';
		}
	}

	echo '<div class="block-text">';
		//дата новости
		if (! empty($row["date"]))
		{
			echo '<div class="news_date date">'.$row["date"].'</div>';
		}
	echo '</div>';

		//название и ссылка новости
		echo '<a href="'.BASE_PATH_HREF.$row["link"].'" class="item__title">'.$row['name'].'</a>';

	    //анонс новости
		echo '<div class="item__desc">'.$row['anons'].'</div>';

		echo '<div class="item-btn-wrap"><a href="'.BASE_PATH_HREF.$row["link"].'" class="btn">читать далее</a></div>';


	echo '</div>';
	echo '</div>';
}
