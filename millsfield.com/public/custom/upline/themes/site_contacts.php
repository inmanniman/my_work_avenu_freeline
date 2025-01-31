<?php
/**
 * шаблон для страницы Контакты
 *
 * @package    DIAFAN.CMS
 * @author     diafan.ru
 * @version    7.0
 * @license    http://www.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2020 OOO «Диафан» (http://www.diafan.ru/)
 */

if(! defined("DIAFAN"))
{
	$path = __FILE__;
	while(! file_exists($path.'/includes/404.php'))
	{
		$parent = dirname($path);
		if($parent == $path) exit;
		$path = $parent;
	}
	include $path.'/includes/404.php';
}
?>

<!-- шаблонный тег подключает файл-блок blocks/head.php -->
<insert name="show_include" file="head"></insert>

<div class="wrapper" itemscope itemtype="https://schema.org/ContactPage">

<!-- шаблонный тег подключает файл-блок blocks/mheader.php -->
<!-- <insert name="show_include" file="mheader"></insert> -->

	<!-- шаблонный тег подключает файл-блок blocks/header.php -->
	<insert name="show_include" file="header"></insert>

    <insert name="show_include" file="nav"></insert>

	<insert name="show_images" module="site" template="contacts"></insert>

	<div class="container" itemscope itemtype="http://schema.org/Organization">
    <meta itemprop="name" content="Millsfield" />
    <div class="page__inner inner_items-flex">
      <MAIN class="container780 main">
        <SECTION class="section-contacts-form">
          <!-- form-->
          <insert name="show_form" module="feedback" site_id="172" template="contact">
            <!-- КОНЕЦ: form-->
        </SECTION>
      </MAIN>
      <ASIDE class="aside right-side aside right-side_2" style="padding-top: 20px;">
        <div class="cont">
<!--          <H3>--><?php //echo $this->diafan->_('title-contact-ru-aside'); ?><!--</H3>-->
<!--          <div class="cont__item" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">-->
<!--            <div itemprop="addressLocality">-->
<!--              <insert name="show_theme" module="site" tag="contacts" useradmin="false"></insert>-->
<!--            </div>-->
<!--          </div>-->
          <!--<A href='tel:<insert name="show_theme" module="site" tag="logo_text" useradmin="false"></insert>' class="cont__item cont__item_phone" itemprop="telephone">
            <insert name="show_theme" module="site" tag="phone" useradmin="false"></insert>
          </A>-->
        </div>
        <div class="cont">
<!--          <H3>--><?php //echo $this->diafan->_('title-contact-cz-aside'); ?><!--</H3>-->
          <div class="cont__item cont__item_address" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
            <div itemprop="addressLocality">
              <insert name="show_theme" module="site" tag="delivery" useradmin="false"></insert>
            </div>
          </div>
          <A href="mailto:info@millsfield.com" class="cont__item cont__item_mail" itemprop="email">
            <insert name="show_theme" module="site" tag="email" useradmin="false"></insert>
          </A>
<!--          <div class="cont__item cont__item_working-hours" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">-->
<!--              <insert name="show_block" module="site" id="5" useradmin="false"></insert>-->
<!--          </div>-->
        </div>
      </ASIDE>
    </div>
  </div>

  <div class="hidden-overley"></div>

  <!-- modal-pp-->
  <div id="modal-pp" class="modal modal-pp">
  	<div class="modal__content"><insert name="show_block" module="site" id="2"></insert></div>
	</div>
	<!-- КОНЕЦ: modal-pp-->

</div>

<!-- шаблонный тег подключает файл-блок blocks/footer.php -->
<insert name="show_include" file="footer"></insert>

<!-- шаблонный тег подключает файл-блок blocks/toolbar.php -->
<insert name="show_include" file="foot"></insert>
