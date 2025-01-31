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

<header class="header">
  <div class="header__inner container">
    <div class="header__logo">
      <a href='<insert name="path_url">' class="logo">
      <img src='/<insert name="custom" path="assets/img/logo2.svg"></insert>' alt="Millsfield"></a>
    </div>
    <!--<div class="header__phone">
      <a href='tel:<insert name="show_theme" module="site" tag="logo_text" useradmin="false"></insert>' class="phone"><insert name="show_theme" module="site" tag="phone" useradmin="false"></insert></a>
    </div>-->
    <insert name="show_block" module="languages">
    <!-- <div class="header__langs">
      <div class="header__lang active">ru</div>
      <div class="header__lang">en</div>
    </div> -->
    <div class="header__nav">
      <div class="pushmenu"><span> </span><span> </span><span> </span><span></span></div>
    </div>
  </div>
</header>
