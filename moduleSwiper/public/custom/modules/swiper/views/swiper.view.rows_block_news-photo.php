<?php
/**
 * Шаблон блока фотографий
 *
 * Шаблонный тег <insert name="show_block" module="swiper" [count="количество"]
 * [cat_id="категория"] [site_id="страница_с_прикрепленным_модулем"]
 * [sort="порядок_вывода"]
 * [images_variation="тег_размера_изображений"]
 * [only_module="only_on_module_page"] [template="шаблон"]>:
 * блок фотографий
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
<div class="swiper mySwiper">
    <div class="swiper-wrapper">
        <?php if (empty($result["rows"])) return false; 
            foreach ($result["rows"] as $row) { ?>
                <div class="swiper-slide">
                    <img
                    src="<?php echo $row['img']['src']; ?>"
                    width="<?php echo $row['img']['width']; ?>"
                    height="<?php echo $row['img']['height']; ?>"
                    alt="<?php echo $row['img']['alt']; ?>"
                    title="<?php echo $row['img']['title']; ?>">
                </div>
            <?php } ?>
        </div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
</div>



