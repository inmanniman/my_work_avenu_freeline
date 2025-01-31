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
    <div class="inner inner__production">
        <insert name="show_dynamic" module="site" id="2">
        <div class="product-sliders" id="certificates">
            <div class="container">
            <div class="product-sliders-wrap">
                <div class="product-sliders-block">
                    <insert name="show_include" file="sertificate"></insert>
                </div>

                <div class="product-sliders-block">
                    <insert name="show_block" module="shop" template="custom" count="10" images="1"></insert>
                    <div class="production"><a href="/produktsiya/proizvodstvo-izdeliy/"><img width="520" height="174" src='/<insert name="custom" path="img/productions.jpg">?v=1' alt="Productions" title="Productions" class="img" loading="lazy"></a></div>
                </div>
            </div>
            </div>
        </div>
    </div>

<insert name="show_include" file="footer"></insert>
</div>
<insert name="show_include" file="foot"></insert>


</body>
</html>
