<?php
/**
 * шаблон для страницы Публикации
 *
 * @package    DIAFAN.CMS
 * @author     diafan.ru
 * @version    7.0
 * @license    http://www.diafan.ru/license.html
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

<!-- шаблонный тег подключает файл-блок blocks/head.php -->
<insert name="show_include" file="head"></insert>

<div class="wrapper">

<!-- шаблонный тег подключает файл-блок blocks/mheader.php -->
<!-- <insert name="show_include" file="mheader"></insert> -->

    <!-- шаблонный тег подключает файл-блок blocks/header.php -->
    <insert name="show_include" file="header"></insert>

    <insert name="show_include" file="nav"></insert>

	<insert name="show_images" module="site" template="publications"></insert>

    <div class="container">
        <!-- модуль новостей -->
        <insert name="show_module"></insert>
    </div>

    <div class="hidden-overley"></div>
</div>
<!-- шаблонный тег подключает файл-блок blocks/footer.php -->
<insert name="show_include" file="footer"></insert>
<!-- шаблонный тег подключает файл-блок blocks/toolbar.php -->
<insert name="show_include" file="foot"></insert>
