<?php
/**
 * Шаблон элементов в списке статей
 *
 * Шаблон вывода списка статей в том случае, если в настройках модуля отключен параметр «Использовать категории»
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

echo '<div class="articles_list_page">';
foreach ($result["rows"] as $row)
{
	echo '<div class="articles_list_page--item">';

	//изображения статьи
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

		//название и ссылка статьи
		echo '<h2><a href="'.BASE_PATH_HREF.$row["link"].'" class="black">'.$row["name"].'</a></h2>';
		//рейтинг статьи
		if (! empty($row["rating"]))
		{
			echo $row["rating"];
		}

		//анонс статьи
		if(! empty($row["anons"]))
		{
			echo '<div class="anons">'.$this->htmleditor($row['anons']).'</div>';
		}

		echo '<div class="articles_list_page--read_more"><a href="'.BASE_PATH_HREF.$row["link"].'">Читать далее</a></div>';


		//дата статьи
		if (! empty($row['date']))
		{
			echo '<div class="date">'.$row["date"]."</div>";
		}

		//теги статьи
		if(! empty($row["tags"]))
		{
			echo $row["tags"];
		}

	echo '</div>';

	echo '</div>';
}
echo '</div>';
