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

<header class="header">
    <div class="header__header-line">
        <div class="container">
        <div class="header__upper">
            <div class="header__block-img">

                <a href="/"><img width="175" height="60" src="/custom/upline/images/logo.png" class="header__logo" loading="lazy" alt="Иконка - logo"></a>

                <svg class="header__liugong">
                    <use href="/assets/sprite.svg?v=1#liugong-desctop"></use>
                </svg>

                <svg class="header__liugong-mob">
                    <use href="/assets/sprite.svg?v=1#liugong"></use>
                </svg>
            </div>

            <div class="header__contact">
                <div class="header__number">
                    <span class="header__help"><insert value="любая помощь с техникой" /></span>
                    <a href='tel:<insert value="site_phone1" />' class="header__number-tel"><insert value="site_phone1_format" /></a>
                </div>

                <div class="header__callback">
                    <span  data-fancybox data-src="#dialog-kp" href="" class="header__chime">
                        <svg class="header__phone">
                            <use href="/assets/sprite.svg#phone"></use>
                        </svg>
                        <div class="header__callback-txt"><insert value="ЗАКАЗАТЬ"><br /><insert value="ОБРАТНЫЙ ЗВОНОК">
                        </div>
                    </span href="">
                </div>

                <a href="/contact/" class="header__icon">
                    <svg class="header__maps-icon">
                        <use href="/assets/sprite.svg#maps"></use>
                    </svg>
                </a>
                <insert name="show_block" module="languages" template="header"></insert>
                <a class="js-mobile-menu-trigger header__mobile-menu">
                    <svg class="header__icon-menu">
                        <use href="/assets/sprite.svg#icon-menu"></use>
                    </svg>
                </a>
            </div>

        </div>
        </div>
    </div>

    <insert name="show_block" module="menu" template="topmenu" id="1">

</header>
