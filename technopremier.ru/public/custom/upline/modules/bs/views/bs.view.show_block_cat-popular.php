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
	'<form method="POST" enctype="multipart/form-data" style="display: none" action="" class="ajax js_bs_form bs_form _hidden">
		<input type="hidden" name="module" value="bs">
		<input type="hidden" name="action" value="click">
		<input type="hidden" name="banner_id" value="0">
	</form>';
}


echo '<section class="catalog-main container-main">';
echo '<div class="catalog-main__title">Техника для всех видов работ</div>';
echo '<div class="catalog-main__wrapper-boxs">';
foreach ($result as $row)
{
	if (! empty($row['link']))
	{
		echo '<a href="'.$row['link'].'" class="catalog-main__box js_bs_counter bs_counter" rel="'.$row['id'].'"'.(! empty($row['target_blank']) ? ' target="_blank"' : '').'>';
	}else{
        echo '<span class="catalog-main__box js_bs_counter bs_counter">';
    }
    //вывод баннера в виде изображения
    if (! empty($row['image']))
    {
        echo '<img class="catalog-main__img" loading="lazy" src="'.BASE_PATH.USERFILES.'/bs/'.$row['image'].'" alt="'.(! empty($row['alt']) ? $row['alt'] : '').'" title="'.(! empty($row['title']) ? $row['title'] : '').'">';
    }

    echo '<div class="catalog-main__wrapper-box-title">';
		echo '<span class="catalog-main__box-title">'. $row['name'] .'</span>';
        echo '<span class="catalog-main__box-btn"><svg class="catalog-main__box-btn-svg" width="20" height="17" viewBox="0 0 20 17" xmlns="http://www.w3.org/2000/svg"><use href="/assets/sprite.svg#arrow-left"></use></svg></span>';
    echo '</div>';

	if (! empty($row['link']))
	{
		echo '</a>';
	}else{
        echo '</span>';
    }
}
echo '</div></section>';
