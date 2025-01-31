<?php
/**
 * Шаблон постраничной навигации для пользовательской части
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

if ($result)
{
	echo '<div class="pagi pagi--right"'.(! empty($result["more"]) && ! empty($result["more"]["uid"]) ? ' uid="'.$result["more"]["uid"].'"' : '').'>';
	echo '<ul class="pagi-nav">';
	foreach ($result as $l)
	{
		echo '<li>';
		switch($l["type"])
		{
			case "more":
				break;

			case "first":
				echo '<a class="start" href="'.BASE_PATH_HREF.$l["link"].'">&#171;</a> ';
				break;

			case "current":
				echo '<span class="current">'.$l["name"].'</span> ';
				break;

			case "previous":
				echo '<a class="arrow arrow-prev " href="'.BASE_PATH_HREF.$l["link"].'" title="'.$this->diafan->_('На предыдущую страницу', false).'">...</a> ';
				break;

			case "next":
				echo '<a class="arrow arrow-next" href="'.BASE_PATH_HREF.$l["link"].'" title="'.$this->diafan->_('На следующую страницу', false).' '.$this->diafan->_('Всего %d', false, $l["nen"]).'">...</a> ';
				break;

			case "last":
				echo '<a class="end" href="'.BASE_PATH_HREF.$l["link"].'">&#187;</a> ';
				break;

			default:
				echo '<a href="'.BASE_PATH_HREF.$l["link"].'">'.$l["name"].'</a> ';
				break;
		}
		echo '</li>';
	}
	echo '</ul>';
	echo '</div>';
}  