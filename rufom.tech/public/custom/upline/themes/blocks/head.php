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

if (!defined('DIAFAN')) {
    $path = __FILE__;
    while (!file_exists($path . '/includes/404.php')) {
        $parent = dirname($path);
        if ($parent == $path) exit;
        $path = $parent;
    }
    include $path . '/includes/404.php';
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>

    <!-- шаблонный тег show_head выводит часть HTML-шапки сайта. Описан в файле themes/functions/show_head.php. -->
    <insert name="show_head"></insert>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- шаблонный тег show_css подключает CSS-файлы. Описан в файле themes/functions/show_css.php. -->
    <link rel="stylesheet" href='/assets/css/app.css?v=30'>


    <meta name="yandex-verification" content="042e2f5b31474347"/>
    <meta name="yandex-verification" content="0dd2a917a9732255"/>
    <meta name="yandex-verification" content="d54baed8b2930d60"/>


    <link rel="apple-touch-icon" sizes="180x180" href='/<insert name="custom" path="img/apple-touch-icon.png">'>
    <link rel="icon" type="image/png" sizes="32x32" href='/<insert name="custom" path="img/favicon-32x32.png">'>
    <link rel="icon" type="image/png" sizes="16x16" href='/<insert name="custom" path="img/favicon-16x16.png">'>
    <link rel="manifest" href='/<insert name="custom" path="img/site.webmanifest">'>
    <link rel="mask-icon" href='/<insert name="custom" path="img/safari-pinned-tab.svg">' color="#5bbad5">
    <meta name="msapplication-TileColor" content="#ffc40d">
    <meta name="theme-color" content="#ffffff">
    <!-- Google Tag Manager -->
    <script>(function (w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start':
                    new Date().getTime(), event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-W3F389L');</script>
    <!-- End Google Tag Manager -->
</head>
