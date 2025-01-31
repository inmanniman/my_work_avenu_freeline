<?php
/**
 * Основной шаблон сайта
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

<insert name="show_include" file="head"/>

<insert name="show_include" file="header"/>

<main>
    <insert name="show_breadcrumb" current="true" separator="<span class='navigation__separator'><svg class='navigation__separator-svg' width='20' height='17' viewBox='0 0 20 17' xmlns='http://www.w3.org/2000/svg'><use href='/assets/sprite.svg#arrow-left'></use></svg></span>"></insert>
    <!-- шаблонный тег вывода основного контента сайта -->

    <insert name="show_module"></insert>
</main>
<insert name="show_include" file="modals"/>
<insert name="show_include" file="footer"/>
