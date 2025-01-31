<?php
/**
 * Шаблон результатов поиска по сайту
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

if(empty($result['rows'])) return false;

foreach ($result["rows"] as $module_name => $res)
{

	echo '<div class="search_list">';
	foreach ($res["rows"] as $row)
	{
		echo '<div class="articles_list_page--item">';
		if (! empty($row["img"]))
		{
			foreach ($row["img"] as $img)
			{
				switch($img["type"])
				{
					case 'animation':
						echo '<a href="'.BASE_PATH.$img["link"].'" data-fancybox="gallery'.$row["id"].'clauses" class="block-row-img">';
						break;
					case 'large_image':
						echo '<a href="'.BASE_PATH.$img["link"].'" rel="large_image" width="'.$img["link_width"].'" height="'.$img["link_height"].'" class="block-row-img">';
						break;
					default:
						echo '<a href="'.BASE_PATH_HREF.$img["link"].'" class="articles_list_page--img">';
						break;
				}
				echo '<img src="'.$img["src"].'" width="'.$img["width"].'" height="'.$img["height"].'" alt="'.$img["alt"].'" title="'.$img["title"].'" loading="lazy">'
				.'</a> ';
			}
		}
		echo '<div class="articles_list_page--text">';
		echo '<h2 class="search_name"><a href="'.BASE_PATH_HREF.$row["link"].'" class="black">'.$row["name"].'</a></h2>';
		if(!empty($row["snippet"])){
			echo '<div class="styled-description">' . $row['snippet'] . '</div>';
		}elseif(!empty($row["anons"])){
			echo '<div class="styled-description">' . $row['anons'] . '</div>';
		}
		echo '<div class="articles_list_page--read_more"><a href="'.BASE_PATH_HREF.$row["link"].'">Перейти</a></div>';
		echo '</div>';
		echo '</div>';

	}
	echo '</div>';
}

//Кнопка "Показать ещё"
if(! empty($result["show_more"]))
{
	echo $result["show_more"];
}
