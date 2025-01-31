<?php
/**
 * Установка модуля
 *
 * @package    DIAFAN.CMS
 * @author     diafan.ru
 * @version    7.0
 * @license    http://www.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2019 OOO «Диафан» (http://www.diafan.ru/)
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



class Yaservice_install extends Install
{
    /**
     * @var string название
     */
    public $title = 'Реклама в Яндекс';

    /**
     * @var array записи в таблице {modules}
     */
    public $modules = array(
		array(
			'name' => 'yaservice',
			'admin' => true,
			'site'=> false,
		),
    );

    /**
     * @var array меню административной части
     */
    public $admin = array(
		array(
			'name' => 'Реклама в Яндекс',
			'rewrite' => 'yaservice',
			'icon_name' => 'yc',
			'group_id' => 3,
			'sort' => 20,
			'act' => true,
		),
    );
}
