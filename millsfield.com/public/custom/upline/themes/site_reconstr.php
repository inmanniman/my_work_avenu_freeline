<?php
/**
 * шаблон для страниц на реконструкции
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

	<insert name="show_images" module="site" template="reconstr"></insert>

    <div class="container">
        <div class="page__inner">
            <MAIN class="container780">
                <!-- шаблонный тег вывода основного контента сайта -->
                <insert name="show_text"></insert>
                <insert name="show_module"></insert>
            </MAIN>

            <ASIDE class="right-side">
                <insert name="show_block" module="menu" id="3" template="aside"></insert>

                <section class="articles section-mg28 art-slider-sec-2">
                    <H3><?php echo $this->diafan->_('aside-title-news'); ?></H3>
                    <div class="articles__slider swiper-container">
                        <div class="articles__inner swiper-wrapper">
                            <insert name="show_block" module="news" site_id="170" count="8" images="1" template="main-page">
                            <hr>
                            <A href='<insert name="path_url">publications/' class="more"><?php echo $this->diafan->_('aside-more-news'); ?>
                                <SVG width="9" height="16" viewBox="0 0 9 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1.16145 0.994812C1.06195 0.994836 0.96471 1.02455 0.882183 1.08015C0.799657 1.13574 0.735595 1.2147 0.698194 1.30691C0.660792 1.39912 0.651751 1.50039 0.67223 1.59777C0.692708 1.69515 0.741773 1.7842 0.813147 1.85354L6.95963 8.00002L0.813147 14.1465C0.765161 14.1926 0.726851 14.2478 0.70046 14.3088C0.674068 14.3699 0.660126 14.4356 0.65945 14.5021C0.658773 14.5686 0.671377 14.6346 0.696522 14.6962C0.721666 14.7578 0.758846 14.8138 0.805885 14.8608C0.852924 14.9078 0.908876 14.945 0.970464 14.9702C1.03205 14.9953 1.09804 15.0079 1.16456 15.0072C1.23108 15.0066 1.29679 14.9926 1.35786 14.9662C1.41892 14.9398 1.47411 14.9015 1.52018 14.8535L8.02018 8.35353C8.11391 8.25976 8.16656 8.13261 8.16656 8.00002C8.16656 7.86743 8.11391 7.74028 8.02018 7.6465L1.52018 1.1465C1.47357 1.09851 1.41781 1.06035 1.35619 1.0343C1.29457 1.00824 1.22835 0.994815 1.16145 0.994812Z" fill="#333333" stroke="#333333" stroke-width="0.5"></path>
                                </SVG>
                            </A>
                        </div>
                    </div>
                </section>
            </ASIDE>
        </div>
    </div>
    <div class="hidden-overley"></div>
</div>
<!-- шаблонный тег подключает файл-блок blocks/footer.php -->
<insert name="show_include" file="footer"></insert>
<!-- шаблонный тег подключает файл-блок blocks/toolbar.php -->
<insert name="show_include" file="foot"></insert>
