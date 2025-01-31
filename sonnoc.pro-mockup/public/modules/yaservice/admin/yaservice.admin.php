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
    /**
	 * Вывести контент модуля
	 * 
	 * @return void
	 */
    public function show()
	{
		if (! $business_num = $this->diafan->configmodules('business_num', 'yaservice', 0, 0))
		{
			$business_num = $this->get_num(getenv('HTTP_HOST').$this->diafan->uid());
			$this->diafan->configmodules('business_num', 'yaservice', 0, 0, $business_num);
		}
		echo '<a href="https://yandex.diafan.ru/direct.html" onclick="yaserviceOpenWindow(this.href); return false;"><img class="yaservice-img" src="https://yandex.diafan.ru/img/direct.webp"></a>';
		echo '<a href="https://yandex.diafan.ru/business.html?n='.$business_num.'" onclick="yaserviceOpenWindow(this.href); return false;"><img class="yaservice-img" src="https://yandex.diafan.ru/img/business.webp"></a>';
    }

	/**
	 * Получить числовой псевдо-id клиента
	 *
	 * @param string $text — строка идентификации клиента
	 * @return string
	 */
	private function get_num($text)
	{
		return base_convert(hash('crc32', $text), 16, 10);
	}
}