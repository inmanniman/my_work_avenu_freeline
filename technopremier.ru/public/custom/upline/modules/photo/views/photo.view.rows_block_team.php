<?php
/**
 * Шаблон блока фотографий
 *
 * Шаблонный тег <insert name="show_block" module="photo" [count="количество"]
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


if (empty($result["rows"])) return false; ?>

<div class="swiper swiper-service ">
    <div class="swiper-wrapper swiper-service-wrapper">
        <?php foreach ($result["rows"] as $row) { ?>
            <div class="swiper-slide swiper-slide-service">
                <div class="slider-images-service">
                    <img class="slider-images-service__picture"
                         srcset="<?php echo $row['img']['vs']['576_920']; ?> 2x"
                         src="<?php echo $row['img']['vs']['288_460']; ?>"
                         width="<?php echo $row['img']['width']; ?>"
                         height="<?php echo $row['img']['height']; ?>"
                         alt="<?php echo $row['name']; ?>" title="<?php echo $row['name']; ?>">
                    <div class="slider-images-service__content">
                        <div class="slider-images-service__name"><?php echo $row['name']; ?></div>
                        <div class="slider-images-service__post"><?php echo $row['anons']; ?></div>
                    </div>
                </div>
            </div>
            <?php //print_r($row); ?>
        <?php } ?>
    </div>
</div>
