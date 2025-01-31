<?php
/**
 * Шаблон элементов в списке товаров
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

if (empty($result['rows'])) return false;

?>
<div class="swiper-block swiper-blue">
    <div class="swiper js-swiper related-products">
        <div class="swiper-wrapper">
            <?php foreach ($result['rows'] as $item) { ?>
                <div class="item swiper-slide">
                    <div class="item-row">
                        <a href="<?= BASE_PATH_HREF . $item['link'] ?>" class="item-img">
                            <img loading="lazy" width="400"
                                 height="300"
                                 src="<?= BASE_PATH . $item['img'][0]['src'] ?>"
                                 alt="<?= $item['img'][0]['alt'] ?>"
                                 title="<?= $item['img'][0]['alt'] ?>"/></a>
                        <a href="<?= BASE_PATH_HREF . $item['link'] ?>" class="item-name"><?= $item['name'] ?></a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="js-swiper-button-prev"><button type="button" class="swiper-two-items-button">‹</button></div>
    <div class="js-swiper-button-next"><button type="button" class="swiper-two-items-button">›</button></div>
</div>
