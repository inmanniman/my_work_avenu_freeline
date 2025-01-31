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



if(empty($result['rows'])) return false;

//новости
foreach ($result['rows'] as $row)
{
    //print_r($result['rows']);

	echo '<a href="'.BASE_PATH_HREF.$row["link"].'" class="articles__item swiper-slide">';

	//изображения новости
	if (! empty($row['img']))
	{
		foreach ($row['img'] as $img)
		{
			echo '<span class="articles__img">
			<img src="'.$img['src'].'" width="'.$img['width'].'" height="'.$img['height'].'" alt="'.$img['alt'].'" title="'.$img['title'].'">
			</span>';
		}

        //название и ссылка новости
        echo '<span class="articles__title">' .$row['name']. '</span>';

        //анонс новости
       if (! empty($row['anons']))
       {
           echo '<span class="articles__info">' .$row['anons']. '</span>';
       }

        //дата новости
        if (! empty($row['date']))
        {
            echo '<span class="articles__date">' .$row['date']. '</span>';
        }
	}
	echo '</a>';
}
