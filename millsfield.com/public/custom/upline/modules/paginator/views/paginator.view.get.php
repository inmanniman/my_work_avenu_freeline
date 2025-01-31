<?php
/**
 * Шаблон постраничной навигации для пользовательской части
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


if ($result)
{
	echo '<ul class="pag"'.(! empty($result["more"]) && ! empty($result["more"]["uid"]) ? ' uid="'.$result["more"]["uid"].'"' : '').'>';

		foreach ($result as $l)
		{
			if ( ($l["type"] == "current") && ($l["name"] == "1")) {
				echo '<li class="pag__item pag__item_prev disabled"><a href="#"><svg width="9" height="13" viewBox="0 0 9 13" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M8.16003 1.65414L3.58003 6.24414L8.16003 10.8341L6.75003 12.2441L0.750034 6.24414L6.75003 0.244141L8.16003 1.65414Z" fill="#BDBDBD"></path></svg></a></li>';
			}

			switch($l["type"])
			{
				case "more":
					echo '<li class="pag__item not-a-link"><span>...</span></li>';
					break;
	
				case "first":
						echo '<li class="pag__item pag__item_prev"><a href="'.BASE_PATH_HREF.$l["link"].'" title="'.$this->diafan->_('В начало', false).'">
						<svg width="9" height="13" viewBox="0 0 9 13" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M8.16003 1.65414L3.58003 6.24414L8.16003 10.8341L6.75003 12.2441L0.750034 6.24414L6.75003 0.244141L8.16003 1.65414Z" fill="#BDBDBD"></path></svg></a></li>';

					break;
	
				case "current":
					echo '<li class="pag__item active"><span>'.$l["name"].'</span></li>';
					break;
	
				case "previous":
					// echo
					// '<a class="paginat-d__item paginat-d__item_prev button-d button-d_narrow button-d_dark" href="'.BASE_PATH_HREF.$l["link"].'" title="'.$this->diafan->_('На предыдущую страницу', false).'">
					// 	<span class="button-d__icon icon-d fas fa-chevron-circle-left"></span>
					// 	<span class="button-d__name">'.$this->diafan->_('Назад').'</span>
					// </a>';
					break;
	
				case "next":
					// echo
					// '<a class="paginat-d__item paginat-d__item_next button-d button-d_narrow button-d_dark" href="'.BASE_PATH_HREF.$l["link"].'" title="'.$this->diafan->_('На следующую страницу', false).' '.$this->diafan->_('Всего %d', false, $l["nen"]).'">
					// 	<span class="button-d__name">'.$this->diafan->_('Вперёд').'</span>
					// 	<span class="button-d__icon icon-d fas fa-chevron-circle-right"></span>
					// </a>';
					break;
	
				case "last":
					echo '<li class="pag__item pag__item_next"><a href="'.BASE_PATH_HREF.$l["link"].'" title="'.$this->diafan->_('В конец', false).'"><svg width="9" height="13" viewBox="0 0 9 13" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.840088 1.65414L5.42009 6.24414L0.840088 10.8341L2.25009 12.2441L8.25009 6.24414L2.25009 0.244141L0.840088 1.65414Z" fill="#BDBDBD"></path></svg></a></li>';
					break;
	
				default:
					echo '<li class="pag__item"><a href="'.BASE_PATH_HREF.$l["link"].'">'.$l["name"].'</a></li>';
					break;
			}

			if (($l["type"] == "current") && ($l["name"] == $result[count($result) - 1]["name"])) {
				echo '<li class="pag__item pag__item_next disabled"><a href="#"><svg width="9" height="13" viewBox="0 0 9 13" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.840088 1.65414L5.42009 6.24414L0.840088 10.8341L2.25009 12.2441L8.25009 6.24414L2.25009 0.244141L0.840088 1.65414Z" fill="#BDBDBD"></path></svg></a></li>';
			}
		}

	echo '</ul>';
}