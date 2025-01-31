<?php
/**
 * Основной шаблон сайта
 *
 * @package    DIAFAN.CMS
 * @author     diafan.ru
 * @version    6.0
 * @license    http://www.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2018 OOO «Диафан» (http://www.diafan.ru/)
 */

if (!defined("DIAFAN")) {
    $path = __FILE__;
    while (!file_exists($path . '/includes/404.php')) {
        $parent = dirname($path);
        if ($parent == $path) exit;
        $path = $parent;
    }
    include $path . '/includes/404.php';
}
?>
<insert name="show_include" file="head"></insert>
<body class="page">
<div class="page__wrap">
    <insert name="show_include" file="header"></insert>
    <div class="top">
        <div class="container">
            <div class="top-wrap">
                <div class="top-slider-wrap">
                    <insert name="show_block" module="bs" sort="rand" cat_id="1" template="slider_home"
                            count="all"></insert>
                </div>
                <div class="top-block">
                    <insert name="show_block" module="bs" sort="date" cat_id="2" template="banners"
                            count="all"></insert>
                </div>
            </div>
            <insert name="show_text"></insert>
            <insert name="show_block" module="site" id="5"></insert>
        </div>
    </div>
    <section class="prod bg bg--1">
        <div class="container">
            <h2 class="c-title prod-title">Наша продукция</h2>
            <insert name="show_category" module="shop" site_id="165" images="1" template="home"></insert>
        </div>
    </section>
    <!--<section class="about">
        <div class="container">
            <h2 class="about-title">О компании</h2>
            <div class="about-text">
                <insert name="show_text">
            </div>
            <div class="about-wrap">
                <insert name="show_block" module="site" id="10">
            </div>
        </div>
    </section>-->
    <section class="news bg bg--1">
        <div class="container">
            <insert name="show_block" module="news" count="3" images="1" template="home"></insert>
        </div>
    </section>
    <insert name="show_block" module="bs" cat_id="3" template="slidergallery" count="all"></insert>

    <insert name="show_include" file="footer"></insert>
</div>
<insert name="show_include" file="foot"></insert>

</body>
</html>
