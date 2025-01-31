<?php
/**
 * Сервисы
 *
 * @package    DIAFAN.CMS
 * @author     diafan.ru
 * @version    7.0
 * @license    http://www.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2021 OOO «Диафан» (http://www.diafan.ru/)
 */
if ( ! defined('DIAFAN'))
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



class Yaservice_admin extends Frame_admin
{
    public function show()
	{
		echo '<a href="https://yandex.diafan.ru/direct.html" onclick="yaserviceOpenWindow(this.href); return false;"><img class="yaservice-img" src="https://yandex.diafan.ru/img/direct.webp"></a>';

		echo '<a href="https://yandex.diafan.ru/business.html" onclick="yaserviceOpenWindow(this.href); return false;"><img class="yaservice-img" src="https://yandex.diafan.ru/img/business.webp"></a>';
    }
}