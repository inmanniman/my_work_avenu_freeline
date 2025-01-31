<?php
/**
 * Шаблон блока похожих файлов
 * 
 * Шаблонный тег <insert name="show_block_rel" module="files" [count="количество"]
 * [images="количество_изображений"] [images_variation="тег_размера_изображений"]
 * [template="шаблон"]>:
 * блок похожих файлов
 * 
 * @package    DIAFAN.CMS
 * @author     diafan.ru
 * @version    7.0
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

//фaйлы
foreach ($result["rows"] as $row)
{
	echo '<article class="element-d element-d_files element-d_files_item _bounded">';

	//изображения файла
	if (! empty($row["img"]))
	{
		echo '<div class="element-d__images _images">';
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
			echo '<img src="'.$img["src"].'" width="'.$img["width"].'" height="'.$img["height"].'" alt="'.$img["alt"].'" title="'.$img["title"].'">'
			.'</a>';
		}
		echo '</div>';
	}

	echo '<div class="element-d__details details-d">';

	//название и ссылка файла
	echo
	'<div class="detail-d detail-d_name">
		<a href="'.BASE_PATH_HREF.$row['link'].'">'.$row['name'].'</a>
	</div>';

	//рейтинг файла
	if (! empty($row["rating"]))
	{
		echo '<div class="detail-d detail-d_rating">'.$row['rating'].'</div>';
	}

	//краткое описание файла
	if(! empty($row["anons"]))
	{
		echo '<div class="detail-d detail-d_anons _text">'.$row['anons'].'</div>';
	}

	//теги файла
	if(! empty($row["tags"]))
	{
		echo '<div class="detail-d detail-d_tags">'.$row["tags"].'</div>';
	}

	//ссылка на скачивание файла
	if(! empty($row["files"]))
	{
		echo '<div class="detail-d detail-d_file">';
		foreach ($row["files"] as $f)
		{
			echo '<div class="file-d">';
			echo '<div class="file-d__details details-d">';

			//имя файла
			if(! empty($f["name"]))
			{
				echo '<div class="detail-d detail-d_name">'.$f["name"].'</div>';
			}
			//размер файла
			if(! empty($f["size"]))
			{
				echo
				'<div class="detail-d detail-d_size">
					<span class="detail-d__name">'.$this->diafan->_('Размер').':</span>
					<span class="detail-d__content">'.$f["size"].'</span>
				</div>';
			}
			echo
			'<div class="detail-d detail-d_link">
				<a class="file-d__link button-d button-d_dark button-d_short" href="'.$f["link"].'">
					<span class="button-d__icon icon-d fas fa-download"></span>
					<span class="button-d__name">'.$this->diafan->_('Скачать').'</span>
				</a>
			</div>';

			echo '</div>';
			echo '</div>';
		}
		echo '</div>';
	}

	echo '</div>';

	echo '</article>';
}