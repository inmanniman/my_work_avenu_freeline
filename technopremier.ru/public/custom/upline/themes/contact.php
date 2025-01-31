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

<main>
    <insert name="show_block" module="bs" template="contact" id="61" />

    <insert name="show_block" module="site" template="maps" id="5" />

    <insert name="show_block" module="bs" template="contact" id="108" />

    <insert name="show_block" module="site" template="maps" id="12" />

</main>
<insert name="show_include" file="modals"/>
<insert name="show_include" file="footer" />
