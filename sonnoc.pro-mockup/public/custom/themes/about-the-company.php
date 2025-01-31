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
	<div class="brand-history container">
		<insert module="bs" name="show_block" template="brand-history" id="18" />
		
		<!-- шаблонный тег вывода навигации "Хлебные крошки"-->

		<insert name="show_breadcrumb" />

		<div class="brand-history__content-wrapper">
			<nav class="brand-history__navigation-wrapper">
				<span class="brand-history__title-navigation"><insert value="Компания Sonnoc"></span>
				<ul class="brand-history__navigation">
					<?php
					for ($a = 20; $a <= 24; $a++) {
					echo '<insert module="bs" name="show_block" template="brand-history-navig" id="'.$a.'">';
					}
					?>
				</ul>
			</nav>
			<div class="brand-history__content">
				<insert	module="bs" name="show_block" 	template="brand-history-info-block" id="19" />
				<ul class="brand-history__list">
					<?php
					for ($x = 20; $x <= 24; $x++) {
						echo '<insert module="bs" name="show_block" template="brand-history-list" id="' . $x . '"/>';
					}
					?>
				</ul>
			</div>
		</div>
	</div>
</main>
			
<insert name="show_include" file="footer" />
			