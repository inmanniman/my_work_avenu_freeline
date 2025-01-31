<?php
/**
 * Шаблон страницы новости
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

//вывод основного текста новости
echo '<div class="content clearfix">';
//изображения новости
echo $this->htmleditor($result['text']);
//ссылки на все новости
if (! empty($result["allnews"]))
{
	echo '<p class="show_all"><a href="'.BASE_PATH_HREF.$result["allnews"]["link"].'" class="btn">'.$this->diafan->_('Вернуться к списку').'</a></p>';
}
echo '</div>';
