<?php
/**
 * Файл-блок шаблона
 *
 * @package    DIAFAN.CMS
 * @author     diafan.ru
 * @version    7.0
 * @license    http://www.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2020 OOO «Диафан» (http://www.diafan.ru/)
 */

?>

<footer class="footer" itemscope itemtype="http://schema.org/WPFooter">
    <div class="container">
        <div class="footer__inner" itemscope itemtype="http://schema.org/Organization">
            <meta itemprop="name" content="Millsfield" />
            <div class="footer__col footer__col_1"><a href="/" class="footer__logo logo"><img src='/<insert name="custom" path="assets/img/logo2.svg"></insert>' alt="Millsfield"></a>
            </div>
            <div class="footer__col footer__col_2">
                <insert name="show_block" module="menu" id="1" template="footer-menu">
            </div>
            <div class="footer__col footer__col_3">
                <insert name="show_block" module="menu" id="3" template="footer-menu">
            </div>
            <div class="footer__col footer__col_4">
                <ul class="footer__list">
                    <li class="footer__item">
                        <!--<A href='tel:<insert name="show_theme" module="site" tag="logo_text" useradmin="false"></insert>' itemprop="telephone">
                        <insert name="show_theme" module="site" tag="phone" useradmin="false"></insert></A><br>-->
                        <A href="mailto:info@millsfield.com" itemprop="email">
                        <insert name="show_theme" module="site" tag="email" useradmin="false"></insert></A>
                    </li>
                    <li class="footer__item" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
                        <div itemprop="addressLocality">
                            <insert name="show_theme" module="site" tag="contacts" useradmin="false"></insert>
                        </div>
                    </li>
                    <li class="footer__item" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
                        <div itemprop="addressLocality">
                            <insert name="show_theme" module="site" tag="delivery" useradmin="false"></insert>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="footer__bottom">
            <insert name="show_block" module="site" id="1"></insert>
        </div>
        <div class="footer__separator"></div>
        <div class="footer__copy">
            <span><span itemprop="copyrightHolder">© MILLSFIELD CAPITAL</span>, <span itemprop="copyrightYear"><?php echo date('Y'); ?></span></span> <span  class="footer__licenses"><?php echo $this->diafan->_('footer_license'); ?></span>
        </div>
    </div>
</footer>
