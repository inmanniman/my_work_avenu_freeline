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

echo '<div class="products-main-block__grid container">';
foreach ($result as $row)
{
	if (! empty($row['link']))
	{
	echo '<a href="'.$row['link'].'" class="products-main-block__product link" rel="'.$row['id'].'"'.(! empty($row['target_blank']) ? ' target="_blank"' : '').'>';
	}

	//вывод баннера в виде изображения
	if (! empty($row['image']))
	{
		echo '<img 
			class="products-main-block__img"
			width="380" 
			height="280"
			src="'.BASE_PATH.USERFILES.'/bs/'.$row['image'].'"
			alt="'.(! empty($row['alt']) ? $row['alt'] : '').'" 
			title="'.(! empty($row['title']) ? $row['title'] : '').'"/>';
	}

	if (! empty($row['name'])) 
	{
		echo '<span class="products-main-block__product-name">'. $row['name'] .'</span>';
	}

	if (! empty($row['alt'])) 
	{
		echo '<span class="products-main-block__product-info caption">'. $row['alt'] .'</span>';
	}
	
	if (! empty($row['link']))
	{
		echo '</a>';
	}
}
echo '</div>';