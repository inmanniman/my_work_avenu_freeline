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
 * @version    6.0
 * @license    http://www.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2018 OOO «Диафан» (http://www.diafan.ru/)
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
    //action=""
	echo '<form method="POST" enctype="multipart/form-data" class="ajax js_bs_form bs_form">
	<input type="hidden" name="module" value="bs">
	<input type="hidden" name="action" value="click">
	<input type="hidden" name="banner_id" value="0">
	</form>';
}

echo '<section id="order" class="order container">';
echo '<div class="order__wrapper-content">';
foreach ($result as $i => $row)
{
	if (! empty($row['html']) || ! empty($row['image']) || ! empty($row['swf']))
	{
        //вывод баннера в виде изображения
        if (! empty($row['image']))
        {
            echo '<div class="order__wrapper-img">';
            echo '<img width="656" height="376" class="order__img" src="'.BASE_PATH.USERFILES.'/bs/'.$row['image'].'" alt="'.(! empty($row['alt']) ? $row['alt'] : '').'" title="'.(! empty($row['title']) ? $row['title'] : '').'">';
            echo '</div>';
        }

        //вывод баннера в виде html разметки
        if (! empty($row['text']))
        {
            echo '<h2 class="order__title base-title">' . $row['name'] . '</h2>';
            echo '<div class="order__content">';
            echo '<div class="order__text">';
            echo $row['text'];
            echo '</div>';
            echo '<button class="order__btn base-button base-button_type_secondary" data-fancybox data-src="#request_modal">Отправить чертеж</button>';
            echo '</div>';
        }

	}
}
echo '</div>';
echo '</section>';
