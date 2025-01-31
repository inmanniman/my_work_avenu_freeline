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

<footer class="footer container">
      <a href="/" class="footer__logo-link link">
        <svg width="121" height="28" class="footer__logo">
          <use href="/assets/sprite.svg#logo"></use>
        </svg>
      </a>
      <div class="footer__line">
	  <insert name="show_block" module="menu" id="3" template="bottom" />
        <div class="footer__contacts">
          <a href="tel:+79661741192" class="footer__contact-link link">+7 (966) 174-11-92</a>
          <a href="mailto:info@sonnoc.pro" class="footer__contact-link link">info@sonnoc.pro</a>
          <button data-fancybox data-src="#form-request" class="footer__btn btn btn_type_primary">Оставить
            заявку</button>
        </div>
      </div>
      <div class="footer__line">
        <span class="footer__copyright">2023 © Sonnoc ™</span>
        <a href="/" class="footer__personal-data link">Политика персональных данных</a>
      </div>
    </footer>

<script type="module" src="/assets/js/app.js"></script>