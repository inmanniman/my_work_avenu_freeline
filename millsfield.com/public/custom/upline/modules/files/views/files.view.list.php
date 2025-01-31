<?php
/**
 * Шаблон вывода списка файлов
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



echo '<h2>';
echo $this->diafan->_('документы_скачивания');
echo '</h2>';

echo '<section class="files">';

//файлы
if(! empty($result["rows"]))
{
	echo $this->get($result["view_rows"], 'files', $result);
}

echo '</section>';
