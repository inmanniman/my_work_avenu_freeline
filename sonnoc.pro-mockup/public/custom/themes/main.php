<?php
/**
 * Шаблон страницы сайта, назначенной по умолчанию как стартовая для сайта
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
<insert name="show_include" file="head" />

<!-- шаблонный тег подключает файл-блок blocks/header.php -->
<insert name="show_include" file="header" />

<insert name="show_block" template="modal-window" module="bs" id="1">

	
<main class="page__main">
	<div class="page__blocks">
		<div class="container">
			<insert name="show_block" module="bs" template="slider-main" cat_id="2" count="all">	
		</div>

		<div class="products-main-block">
			<div class="container">
				<h1 class="products-main-block__title title"><insert value="Продукция" /></h1>
				<p class="products-main-block__caption caption">
					<insert value="Cовременный модельный ряд Sonnoc включает в себя
					короткофокусные,
					портативные и инсталляционные проекторы как с ламповыми,
					так и с лазерными источниками света" />
				</p>
			</div>

			<insert module="bs" name="show_block" template="product-main" cat_id="3" count="all" />			
		</div>

		<insert module="bs" name="show_block" template="advantages" cat_id="4" count="all" />

		<div class="installations container">
          <h2 class="installations__title installations__title_center title"><insert value="Примеры инсталляций" /></h2>
          <p class="installations__title-caption"><insert value="Можете убедиться в качестве нашей продукции по их работам." /></p>
		  <div class="installations__grid installations__grid_adaptive">
            <div class="installations__column">
              <div class="installations__grid">
                <a href="/" class="installations__img-wrapper">
                  <figure>
					<insert module="bs" name="show_block" template="installations" id="13" />
                  </figure>
                </a>
                <a href="/" class="installations__img-wrapper">
                  <figure>
				  	<insert module="bs" name="show_block" template="installations" id="14" />
                  </figure>
                </a>
              </div>
              <a href="/" class="installations__img-wrapper">
                <figure>
					<insert module="bs" name="show_block" template="installations" id="15" />
                </figure>
              </a>
            </div>
            <a href="/" class="installations__img-wrapper">
              <figure>
					<insert module="bs" name="show_block" template="installations" id="16" />
              </figure>
            </a>
          </div>
		</div>

		<insert module="bs" name="show_block" template="form-block" id="17" />
	</div>
</main>
			
<insert name="show_include" file="footer" />
			