<?php
/**
 * Файл-блок шаблона
 *
 * @package    DIAFAN.CMS
 * @author     diafan.ru
 * @version    7.0
 * @license    http://www.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2020 OOO «Диафан» (http://www.diafan.ru/)
 */

?>

<header class="header container">
	<a href="/" class="header__logo-link link">
	<svg class="header__logo" width="121" height="28">
		<use href="/assets/sprite.svg#logo"></use>
	</svg>
	</a>
	<div class="header__search-menu-wrapper">

		<insert name="show_search" module="search" template="header"/>

		<insert name="show_block" module="menu" id="1" template="top" />
	</div>
	<div class="header__contacts">
		<a href="tel:+79661741192" class="header__contact-link link">+7 (966) 174-11-92</a>
		<a href="mailto:info@sonnoc.pro" class="header__contact-link link">info@sonnoc.pro</a>
		<button data-fancybox data-src="#form-request" class="header__btn-application btn btn_type_primary">Оставить
			заявку</button>
	</div>
	<button class="header__burger btn js-m-menu-btn-open">
        <svg width="28" height="18">
          <use href="/assets/sprite.svg#burger"></use>
        </svg>
	</button>
</header>