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

<footer class="footer">
    <div class="container">
        <div class="footer__contact">
            <span class="footer__text"><insert value="Контакты"/></span>
            <a class="footer__number" href='tel:<insert value="site_phone1" />'>
                <insert value="site_phone1_format"/>
            </a>
            <span class="footer__address"><insert value="site_adress"/></span>
            <button class="footer__callback" data-fancybox data-src="#dialog-kp">
                <insert value="вам перезвонить?"/>
            </button>

            <a class="footer__made-by-whom" href="https://kashinmedia.com"><insert value="САЙТ СДЕЛАН В&nbsp;<b>KASHIN MEDIA</b>"/></a>
        </div>
    </div>
</footer>

</div>
<insert name="show_js"/>
<insert name="show_block" module="menu" template="mobile-menu" id="3"></insert>
</body>
</html>
