<?php
/**
 * Файл-блок шаблона
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
?>
<insert name="show_block" module="site" id="14" template="spec-header"></insert>
<header class="header">
	<div class="container">
		<div class="header-wrap">
			<a href='<insert name="path_url">' class="logo">
				<img src='<insert name="path_url"><insert name="custom" path="img/logo-tiger.png">?v=3' width="260" height="72" alt="logo" title="logo" class="logo-img" loading="lazy">
			</a>
            <div class="header-item header-item--time">
                <div class="item-icon">
                    <i class="ic ic--time"></i>
                </div>
                <div class="item-info">
                    <div class="line"><a href='mailto:<insert name="show_block" module="site" id="6">' class="link mail"><insert name="show_block" module="site" id="6"></a></div>
                    <div class="line wsk"><span class="day">ПН-ЧТ</span><span class="time"><insert name="show_block" module="site" id="11"></span></div>
                    <div class="line wsk"><span class="day">ПТ</span><span class="time"><insert name="show_block" module="site" id="12"></span></div>
                </div>
            </div>
			<insert name="show_block" module="site" id="7">
			<div class="header-contact">
				<a href="#request_modal" data-fancybox class="btn">заявка на расчет</a> <br>
				<span class="header-contact__text">Расчет - бесплатно!</span>
			</div>
			<button class="hum js-mobile-menu-trigger">
				<i class="ic ic--hum"></i>
				<span class="hum-text">Меню</span>
			</button>
		</div>
	</div>
</header>
<div class="nav-block">
	<div class="container">
		<div class="nav-wrap">
			<div class="nav-mob-head">
				<div class="nav-mob-head-text">меню</div>
				<button class="nav-mob-close"><i class="ic ic--cross"></i></button>
			</div>
			<insert name="show_block" module="menu" id="1" template="topmenu">
            <insert name="show_search" module="search" template="topsearch">
			<!--<form action="#" class="form search">
				<input type="search" name="q" placeholder="Поиск по сайту..." class="form-input">
			</form>-->
		</div>
	</div>
</div>
