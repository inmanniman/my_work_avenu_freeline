<?php
/**
 * Шаблон страницы файла
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



echo '<section class="section-d section-d_id section-d_files section-d_files_id">';

//описание файла
echo '<div class="_text">'.$result['text'].'</div>';

//изображения файла
if(! empty($result["img"]))
{
	echo '<div class="_images">';
	foreach($result["img"] as $img)
	{
		switch($img["type"])
		{
			case 'animation':
				echo '<a href="'.BASE_PATH.$img["link"].'" data-fancybox="gallery'.$result["id"].'files">';
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

//счетчик просмотров
if(! empty($result["counter"]))
{
	echo
	'<div class="counter-d">
		<span class="counter-d__name">'.$this->diafan->_('Просмотров').':</span>
		<span class="counter-d__value">'.$result["counter"].'</span>
	</div>';
}

//теги файла
if (! empty($result["tags"]))
{
	echo $result["tags"];
}

//ссылка на скачивание файла
if (! empty($result["files"]))
{
	echo '<div class="files-d">';
	foreach ($result["files"] as $f)
	{
		echo
		'<div class="file-d">
			<div class="file-d__details details-d">';
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
				echo
			'</div>
		</div>';
	}
	echo '</div>';
}

//рейтинг файла
if(! empty($result["rating"]))
{
	echo $result["rating"];
}

//комментарии к файлу
if(! empty($result["comments"]))
{
	echo $result["comments"];
}

//ссылки на предыдущий и последующий файл
echo $this->htmleditor('<insert name="show_previous_next" module="files">');

echo '</section>';

echo $this->htmleditor('<insert name="show_block_rel" module="files" count="4" images="1">');
