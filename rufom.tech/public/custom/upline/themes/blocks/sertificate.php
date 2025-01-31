<?php
/**
 * Файл-блок шаблона
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
?>
<div class="sert">
    <div class="s-title">Лицензии и сертификаты:</div>
    <div class="swiper-block">
        <div class="swiper js-swiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <a href="/userfls/editor/large/482_sert-01.jpg" data-fancybox="sert"
                       class="item-link">
                        <img width="251" height="355" alt="Сертификат"
                             title="Сертификат" class="item-img"
                             src="/userfls/editor/large/482_sert-01.jpg"
                             loading="lazy">
                    </a>
                </div>
                <div class="swiper-slide">
                    <a href="/userfls/editor/large/481_sert-2020.jpg" data-fancybox="sert"
                       class="item-link">
                        <img width="251" height="355" alt="Сертификат"
                             title="Сертификат" class="item-img"
                             src="/userfls/editor/medium/481_sert-2020.jpg"
                             loading="lazy">
                    </a>
                </div>
                <div class="swiper-slide">
                    <a href="/userfls/editor/large/482_sert-01.jpg" data-fancybox="sert"
                       class="item-link">
                        <img width="251" height="355" alt="Сертификат"
                             title="Сертификат" class="item-img"
                             src="/userfls/editor/large/482_sert-01.jpg"
                             loading="lazy">
                    </a>
                </div>
                <div class="swiper-slide">
                    <a href="/userfls/editor/large/481_sert-2020.jpg" data-fancybox="sert"
                       class="item-link">
                        <img width="251" height="355" alt="Сертификат"
                             title="Сертификат" class="item-img"
                             src="/userfls/editor/medium/481_sert-2020.jpg"
                             loading="lazy">
                    </a>
                </div>
            </div>
        </div>
        <div class="js-swiper-button-prev">
            <button type="button" class="swiper-two-items-button">‹</button>
        </div>
        <div class="js-swiper-button-next">
            <button type="button" class="swiper-two-items-button">›</button>
        </div>
    </div>
</div>
