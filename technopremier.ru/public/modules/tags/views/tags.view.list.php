<?php
/**
 * Шаблон списка элементов, к которым прикреплен тег
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



echo '<section class="section-d section-d_list section-d_tags">';

//вывод описания тега
if(! empty($result["text"]))
{
	echo '<div class="_text">'.$result['text'].'</div>';
}

if(! empty($result["img"]))
{
	echo '<div class="_images">';
	foreach($result["img"] as $img)
	{
		switch($img["type"])
		{
			case 'animation':
				echo '<a href="'.BASE_PATH.$img["link"].'" data-fancybox="gallerytags">';
				break;
			case 'large_image':
				echo '<a href="'.BASE_PATH.$img["link"].'" rel="large_image" width="'.$img["link_width"].'" height="'.$img["link_height"].'">';
				break;
			default:
				echo '<a href="'.BASE_PATH_HREF.$img["link"].'">';
				break;
		}
		if($img["source"])
		{
			echo $img["source"];
		}
		else
		{
			echo '<img src="'.$img["src"].'" width="'.$img["width"].'" height="'.$img["height"].'" alt="'.$img["alt"].'" title="'.$img["title"].'">';
		}
		echo '</a>';
	}
	echo '</div>';
}

if(! empty($result["rows"]))
{
	echo '<div class="section-d__list">';
	echo $this->get($result["view_rows"], 'tags', $result);
	echo '</div>';
}

//постраничная навигация
if(! empty($result["paginator"]))
{
	echo $result["paginator"];
}

echo '</section>';
