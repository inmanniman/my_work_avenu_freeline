<?php
/**
 * Шаблон страницы сайта, назначенной по умолчанию как стартовая для сайта
 *
 * @package    DIAFAN.CMS
 * @author     diafan.ru
 * @version    7.0
 * @license    http://www.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2020 OOO «Диафан» (http://www.diafan.ru/)
 */

if(! defined("DIAFAN"))
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
?>

<!-- шаблонный тег подключает файл-блок blocks/head.php -->
<insert name="show_include" file="head" />

<!-- шаблонный тег подключает файл-блок blocks/header.php -->
<insert name="show_include" file="header" />

<insert name="show_block" template="modal-window" module="bs" id="1">

<main class="page__main">
    <div class="container">
        <insert name="show_breadcrumb" />

        <div class="contacts">
            <insert module="bs" name="show_block" template="contacts" id="28" />
            <insert module="bs" name="show_block" template="contacts" id="29" />
        </div>
    </div>

</main>
			
<insert name="show_include" file="footer" />
			