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
<footer class="footer">
    <div class="container">
        <div class="footer-wrap">
            <insert name="show_block" module="menu" id="3" template="footer"/>
            <div class="footer-form">

                <div class="footer-form-title">Подпишитесь на нашу рассылку:</div>
                <insert name="show_form" module="subscription" template="custom">
            </div>
            <div class="footer-item">
                <div class="item-info">
                    <div class="item-icon"><i class="ic ic--phone-dark"></i></div>
                    <a href='tel:<insert name="show_block" module="site" id="16">' class="phone">
                        <insert name="show_block" module="site" id="8">
                    </a>
                </div>
                <div class="item-info">
                    <div class="item-icon">
                        <img src='/<insert name="custom" path="img/icons/logotype.svg">'
                             style="width: 20px; vertical-align: middle;" alt="Viber" title="Viber" loading="lazy">
                        <img src='/<insert name="custom" path="img/icons/social-media.svg">'
                             style="width: 20px; vertical-align: middle;" alt="WhatsApp" title="WhatsApp"
                             loading="lazy">
                        <img src='/<insert name="custom" path="img/icons/telegram.svg">'
                             style="width: 20px; vertical-align: middle;" alt="Telegram" title="Telegram"
                             loading="lazy">
                    </div>
                    <a href='<insert name="show_block" module="site" id="15">' class="phone">
                        <insert name="show_block" module="site" id="13">
                    </a>
                </div>
                <div class="item-info">
                    <a href="#feedback_modal" data-fancybox class="link">Обратный звонок</a>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="footer-bottom-wrap">
                <div class="footer-copyright">2012 - <?php echo date('Y'); ?> © Руфом - производство и продажа изделий
                    из резины. Любое использование либо копирование материалов или подборки материалов сайта, элементов
                    дизайна и оформления допускается лишь с разрешения правообладателя и только со ссылкой на источник:
                    www.rufom.tech
                </div>
                <a href="/privacy/" class="link link--white policy">Политика конфиденциальности</a>
            </div>
        </div>
    </div>
</footer>

<div id="request_modal" class="modal_form">
    <insert name="show_form" module="feedback" template="custom" site_id="188"/>
</div>

<div id="request2_modal" class="modal_form">
    <insert name="show_form" module="feedback" template="custom2" site_id="192"/>
</div>

<div id="feedback_modal" class="modal_form">
    <insert name="show_form" module="feedback" template="custom" site_id="189"/>
</div>

<div class="js-mobile-menu" hidden>
    <insert name="show_block" module="menu" id="1" template="mmenu"/>
    <template class="js-mobile-menu-socials">
        <ul class="mmenu-socials">
            <li class="mmenu-socials__item">
                <a
                    href="viber://chat?number=%2B79266155998"
                    target="_blank"
                    rel="nofollow noreferrer"
                    class="mmenu-socials__link"
                ><img src="/custom/upline/img/icons/logotype.svg" class="mmenu-socials__img" alt="Viber"
                      title="Viber"></a
                >
            </li>
            <li class="mmenu-socials__item">
                <a
                    href="https://wa.me/79266155998"
                    target="_blank"
                    rel="nofollow noreferrer"
                    class="mmenu-socials__link"
                ><img src="/custom/upline/img/icons/social-media.svg" class="mmenu-socials__img" alt="WhatsApp"
                      title="WhatsApp"></a
                >
            </li>
            <li class="mmenu-socials__item">
                <a href="https://t.me/+79266155998"
                   target="_blank"
                   rel="nofollow noreferrer"
                   class="mmenu-socials__link">
                    <img src="/custom/upline/img/icons/telegram.svg" class="mmenu-socials__img" alt="Telegram"
                         title="Telegram">
                </a>
            </li>
            <li class="mmenu-socials__item">
                <a
                    href="tel://88007078985"
                    target="_blank"
                    rel="nofollow noreferrer"
                    class="mmenu-socials__link"
                ><img src="/custom/upline/img/icons/telephone.svg" class="mmenu-socials__img" alt="Telephone"
                      title="Telephone"></a
                >
            </li>
            <li class="mmenu-socials__item">
                <a
                    href="mailto:info@neopren.com.ru"
                    target="_blank"
                    rel="nofollow noreferrer"
                    class="mmenu-socials__link"
                ><img src="/custom/upline/img/icons/envelopes.svg" class="mmenu-socials__img" alt="E-mail"
                      title="E-mail"></a
                >
            </li>
        </ul>
    </template>
</div>
