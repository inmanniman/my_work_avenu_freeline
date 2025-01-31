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

<insert name="show_include" file="head" />
<insert name="show_include" file="header" />

<section class="catalog">
    <div class="catalog__wrapper-content">
        <div class="catalog__wrapper-boxs">
            <insert name="show_block" module="bs" template="cats" cat_id="7" count="all" />
        </div>
    </div>
</section>

<insert name="show_include" file="footer" />
