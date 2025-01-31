<?php
/**
 * Ошибка 404. Страница не найдена
 *
 * Шаблон оформления страниц 404 (Не найдено)
 *
 * @package    DIAFAN.CMS
 * @author     diafan.ru
 * @version    7.0
 * @license    http://www.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2021 OOO «Диафан» (http://www.diafan.ru/)
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
<!-- шаблонный тег подключает файл-блок blocks/head.php -->
<insert name="show_include" file="head"></insert>

<div class="wrapper">
    <div class="box404">
        <div class="box404__title">404</div>
        <div>
            <h1 style="font-weight: normal;"><?php echo $this->diafan->_('Данной страницы не существует.'); ?></h1>
            <span><?php echo $this->diafan->_('Вы можете'); ?><a style="color: #3c6dae;" href="/"> <?php echo $this->diafan->_('перейти на главную страницу сайта'); ?></a></span>
        </div>
    </div>
    <!-- articles-->
    <section class="articles section-mg65 art-slider-sec">
        <div class="container">
    	    <div class="articles__slider swiper-container">
        	    <div class="articles__inner swiper-wrapper">
					<insert name="show_block" module="news" site_id="170" count="8" images="1" template="main-page">
            	</div>
          	</div>
        </div>
    </section>
    <!-- КОНЕЦ: articles-->
</div>

<!-- шаблонный тег подключает файл-блок blocks/footer.php -->
<insert name="show_include" file="footer"></insert>
<!-- шаблонный тег подключает файл-блок blocks/toolbar.php -->
<insert name="show_include" file="foot"></insert>
