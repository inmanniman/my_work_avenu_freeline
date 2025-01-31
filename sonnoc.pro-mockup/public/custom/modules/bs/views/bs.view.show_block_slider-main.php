<?php
/**
 * Шаблон блока баннеров
 *
 * Шаблонный тег <insert name="show_block" module="bs" [count="all|количество"]
 * [cat_id="категория"] [id="номер_баннера"] [template="шаблон"]>:
 * блок баннеров
 *
 * @package    DIAFAN.CMS
 * @author     diafan.ru
 * @version    7.0
 * @license    http://www.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2021 OOO «Диафан» (http://www.diafan.ru/)
 */

if (! defined('DIAFAN'))
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



if (empty($result))
{
	return false;
}

if(! isset($GLOBALS['include_bs_js']))
{
	$GLOBALS['include_bs_js'] = true;
	//скрытая форма для отправки статистики по кликам
	echo
	'<form method="POST" enctype="multipart/form-data" action="" class="ajax js_bs_form bs_form _hidden">
		<input type="hidden" name="module" value="bs">
		<input type="hidden" name="action" value="click">
		<input type="hidden" name="banner_id" value="0">
	</form>';
}

echo '<div class="swiper main-swiper">
<div class="swiper-wrapper">';

foreach ($result as $row)
{
    echo '<div class="swiper-slide">';

        //вывод баннера в виде изображения
        if (! empty($row['image']))
        {
            echo '<img class="main-swiper__img" loading="lazy" width="1180" height="550" src="'.BASE_PATH.USERFILES.'/bs/'.$row['image'].'" alt="'.(! empty($row['alt']) ? $row['alt'] : '').'" title="'.(! empty($row['title']) ? $row['title'] : '').'">';
        }
	echo "</div>";
}

echo '
</div>
<div class="main-swiper__numbering swiper-pagination"></div>
	<div class="main-swiper__navigation">
	<button class="btn main-swiper__prev swiper-button-prev"></button>
	<button class="btn main-swiper__next swiper-button-next"></button>
</div>
</div>
';
