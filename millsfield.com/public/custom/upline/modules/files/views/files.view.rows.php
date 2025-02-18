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



if(empty($result['rows'])) return false;

//print_r($result);

//файлы
foreach ($result["rows"] as $row)
{
	//ссылка на скачивание файла
	if(! empty($row["files"]))
	{
        echo '<a href="'.$row["files"][0]["link"].'">';
        echo '<div class="files__item">'.$row["name"].'</div>';
        echo '</a>';
	}
}
