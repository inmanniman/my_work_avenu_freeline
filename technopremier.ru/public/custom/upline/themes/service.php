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
    <section class="service">
        <insert name="show_block" module="bs" template="authorized-service" id="14"/>

        <insert name="show_block" module="bs" template="authorized-service-yellow" id="15"/>
    </section>

    <section class="type-work" id="basic">
        <div class="type-work__content container">
        <h2 class="type-work__title"><insert value="Основные виды работ, которые мы оказываем"></h2>
            <insert name="show_block" module="bs" template="type-work" cat_id="8" count="all"/>
        </div>
    </section>

    <section class="how-work" id="how-we-work">
        <div class="how-work__wrapper-content container">
            <insert name="show_block" module="bs" template="heading-how-work" id="33"/>

            <insert name="show_block" module="bs" template="how-work" cat_id="10" count="all"/>

            <insert name="show_block" module="site" template="how-work-one-block" id="2"/>
        </div>
    </section>

    <section class="team">
        <span class="team__title">
            <insert value="Качественный результат"></insert>
            <span class="team__title-min">
                <insert value="обеспечивает наша команда механиков"></insert>
            </span>
        </span>

        <insert name="show_block" module="photo" cat_id="1" count="50" template="team"/>
    </section>

    <insert name="show_block" module="bs" template="banner" id="41"/>

    <insert name="show_block" module="bs" template="proposal" id="40"/>
    <insert name="show_include" file="warranty"/>

</main>
<insert name="show_include" file="modals"/>
<insert name="show_include" file="footer"/>
