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
    <insert name="show_include" file="leasing-offer"/>


    <insert name="show_block" module="shop" count="6" images="1" images_variation="medium" template="leasing-leasing">

    <insert name="show_block" module="bs" template="banner" id="41" />

    <section class="approbals container" id="leasing-approval">
        <insert name="show_block" module="site" template="approbals-title" id="4" />

        <insert name="show_block" module="bs" template="approbals" cat_id="16" count="all" />
    </section>

    <insert name="show_block" module="bs" template="proposal-on-lease" id="60" />
</main>
<insert name="show_include" file="modals"/>
<insert name="show_include" file="footer" />

