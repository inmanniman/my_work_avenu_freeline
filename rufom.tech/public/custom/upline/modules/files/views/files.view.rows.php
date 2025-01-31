<?php
/**
 * Шаблон вывода списка файлов
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

//файлы
foreach ($result["rows"] as $row)
{
	echo '<div class="files">';

	//название и ссылка файла


	//изображения файла
	if (! empty($row["img"]))
	{
		echo '<div class="files_img">';
		foreach ($row["img"] as $img)
		{
			switch($img["type"])
			{
				case 'animation':
					echo '<a href="'.BASE_PATH.$img["link"].'" data-fancybox="gallery'.$row["id"].'files">';
					break;
				case 'large_image':
					echo '<a href="'.BASE_PATH.$img["link"].'" rel="large_image" width="'.$img["link_width"].'" height="'.$img["link_height"].'">';
					break;
				default:
					echo '<a href="'.BASE_PATH_HREF.$img["link"].'">';
					break;
			}
			echo '<img src="'.$img["src"].'" width="'.$img["width"].'" height="'.$img["height"].'" alt="'.$img["alt"].'" title="'.$img["title"].'" loading="lazy">'
			.'</a> ';
		}
		echo '</div>';
	}else{
        echo '<div class="files_img">';
        echo '<img src="/custom/upline/img/pdf.svg" width="30" height="30" alt="pdf" title="pdf" loading="lazy">';
        echo '</div>';
    }



	//ссылка на скачивание файла
	if(! empty($row["files"]))
	{
		foreach ($row["files"] as $f)
		{
			echo '<div class="files_download">';
			echo '<a href="'.$f["link"].'"><i class="fa fa-download"></i>'.$row["name"].'</a>';

				//размер файла
				if (! empty($f["size"])) echo ' ('.$f["size"].')';
			echo '</div>';
		}
	}

	echo '</div>';
}

//Кнопка "Показать ещё"
if(! empty($result["show_more"]))
{
	echo $result["show_more"];
}