<?php
/**
 * Основной шаблон сайта
 *
 * @package    DIAFAN.CMS
 * @author     diafan.ru
 * @version    7.0
 * @license    http://www.diafan.ru/license.khtml
 * @copyright  Copyright (c) 2003-2020 OOO «Диафан» (http://www.diafan.ru/)
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

<insert name="show_include" file="head"/>
<insert name="show_include" file="header"/>

<main>

    <insert module="photo" name="show_block" template="swiper-main" cat_id="2" count="10" />
    <insert module="photo" name="show_block" template="swiper-mainm" cat_id="3" count="10" />

    <insert name="show_include" file="block-warranty-main"/>

    <insert module="shop" name="show_block" template="small-blocks" count="6" images="1" images_variation="medium" />

    <insert name="show_include" file="full-range"/>

    <insert name="show_block" module="bs" cat_id="23" template="cat-popular" count="all" />

    <insert name="show_include" file="seven-reasons"/>

    <insert name="show_include" file="why-liu-gong"/>

    <div class="container-main-swiper">
        <div class="yellow-banner">
            <insert name="show_block" module="bs" template="banner" id="41"/>
        </div>
    </div>

    <insert name="show_block" module="bs" cat_id="25" template="construction" count="all" />
    <!-- <insert name="show_block" module="bs" template="reasons" id="3" /> -->

    <!-- <insert name="show_block" module="bs" cat_id="19" template="home-cat" count="all" /> -->

    <!-- <insert name="show_block" module="shop" count="6" images="1" images_variation="medium" template="leasing-home" /> -->

</main>
<insert name="show_include" file="modals" />
<insert name="show_include" file="footer" />


