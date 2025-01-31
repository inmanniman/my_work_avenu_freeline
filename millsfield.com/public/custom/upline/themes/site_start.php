<?php
/**
 * шаблон для стартовой страницы сайта
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

<div class="wrapper">

<!-- шаблонный тег подключает файл-блок blocks/mheader.php -->
<!-- <insert name="show_include" file="mheader"></insert> -->

	<!-- шаблонный тег подключает файл-блок blocks/header.php -->
	<insert name="show_include" file="header"></insert>

    <insert name="show_include" file="nav"></insert>

	<insert name="show_images" module="site"></insert>

	<section class="block2 block2 section-mg56">
        <div class="block2__inner container">
    	    <div class="block2__item"><?php echo $this->diafan->_('invest-block-1-col'); ?></div>
        	<div class="block2__item"><?php echo $this->diafan->_('invest-block-2-col'); ?></div>
          	<div class="block2__item"><?php echo $this->diafan->_('invest-block-3-col'); ?></div>
          	<div class="block2__item"><a href="#modal1" class="btn btn-invest callModal-1" data-auto-focus="false">
			  <?php echo $this->diafan->_('invest-block-4-col'); ?>
<!--            <SVG width="9" height="16" viewBox="0 0 9 16" fill="none" xmlns="http://www.w3.org/2000/svg">-->
<!--              <path d="M1.16145 0.994812C1.06195 0.994836 0.96471 1.02455 0.882183 1.08015C0.799657 1.13574 0.735595 1.2147 0.698194 1.30691C0.660792 1.39912 0.651751 1.50039 0.67223 1.59777C0.692708 1.69515 0.741773 1.7842 0.813147 1.85354L6.95963 8.00002L0.813147 14.1465C0.765161 14.1926 0.726851 14.2478 0.70046 14.3088C0.674068 14.3699 0.660126 14.4356 0.65945 14.5021C0.658773 14.5686 0.671377 14.6346 0.696522 14.6962C0.721666 14.7578 0.758846 14.8138 0.805885 14.8608C0.852924 14.9078 0.908876 14.945 0.970464 14.9702C1.03205 14.9953 1.09804 15.0079 1.16456 15.0072C1.23108 15.0066 1.29679 14.9926 1.35786 14.9662C1.41892 14.9398 1.47411 14.9015 1.52018 14.8535L8.02018 8.35353C8.11391 8.25976 8.16656 8.13261 8.16656 8.00002C8.16656 7.86743 8.11391 7.74028 8.02018 7.6465L1.52018 1.1465C1.47357 1.09851 1.41781 1.06035 1.35619 1.0343C1.29457 1.00824 1.22835 0.994815 1.16145 0.994812Z" fill="#333333" stroke="#333333" stroke-width="0.5"></path>-->
<!--            </SVG>-->
                </a>
        	</div>
        </div>
    </section>
      <!-- КОНЕЦ: block2-->

      <!-- articles-->
    <section class="articles section-mg65 art-slider-sec">
        <div class="container">
    	    <div class="articles__slider_h swiper-container">
        	    <div class="articles__inner swiper-wrapper">
					<insert name="show_block" module="news" site_id="170" count="8" images="1" template="main-page">
            	</div>
          	</div>
        </div>
    </section>
    <!-- КОНЕЦ: articles-->

    <!-- hedgeFond-->
	<insert name="show_block" module="bs" id="1" template="what_is_hedge">

	<!-- graph-->
	<!-- <insert name="show_block" module="bs" id="2" template="graph"> -->
	<insert name="show_include" file="graph" />

	<!-- answers-->
	<section class="infoForm answers section-mg56 section-mgt75">
		<div class="infoForm__inner container">
			<div class="infoForm__info">
				<!-- tabs-->
				<insert name="show_block" module="bs" cat_id="1" count="all" template="faq">
			</div>

			<div class="infoForm__form">
				<!-- form-->
				<insert name="show_form" module="feedback" site_id="172" template="questions">
			</div>
		</div>
	</section>
	<!-- КОНЕЦ: answers-->

	<div class="hidden-overley"></div>
	<div class="overlay">
	<!-- modal1-->
		<div id="modal1" class="modal modal1">
			<insert name="show_form" module="feedback" site_id="178" template="invest"></insert>
		</div>
		<!-- КОНЕЦ: modal1-->
		<!-- modal-pp-->
		<div id="modal-pp" class="modal modal-pp">
			<div class="modal__content">
			<insert name="show_block" module="site" id="2"></insert>
			</div>
		</div>
	<!-- КОНЕЦ: modal-pp-->
	</div>
</div>

<!-- шаблонный тег подключает файл-блок blocks/footer.php -->
<insert name="show_include" file="footer"></insert>

<!-- шаблонный тег подключает файл-блок blocks/toolbar.php -->
<insert name="show_include" file="foot"></insert>
