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

echo '<section class="proposal proposal-second">';
echo '<div class="proposal__block proposal-second__block container">';

foreach ($result as $row)
{
    if (! empty($row['link']))
    {
        echo '<a href="'.$row['link'].'" class="js_bs_counter bs_counter" rel="'.$row['id'].'"'.(! empty($row['target_blank']) ? ' target="_blank"' : '').'>';
    }

    //вывод баннера в виде html разметки
    if (! empty($row['html']))
    {
        echo $row['html'];
    }

    //вывод баннера в виде изображения
    if (! empty($row['image']))
    {
        echo '<div class="proposal__img-wrapper proposal__img-wrapper_second">';
        echo '<img class="proposal__human proposal-second__human-second" loading="lazy" src="'.BASE_PATH.USERFILES.'/bs/'.$row['image'].'" alt="'.(! empty($row['alt']) ? $row['alt'] : '').'" title="'.(! empty($row['title']) ? $row['title'] : '').'">';
        echo '</div>';
    }

    if (! empty($row['text']))
    {
        echo '<div class="proposal__txt proposal-second__txt">';
            echo '<h3 class="proposal__title">'.$row['name'].'</h3>';
            echo '<span class="proposal__desc proposal-second__desc">'.$row['alt'].'</span>';
            echo '<button data-fancybox data-src="#dialog-survey" class="proposal__btn proposal-second__btn"><span class="proposal__btn-txt proposal-second__btn-txt">'.strip_tags($row['text']).'</span></button>';
        echo '</div>';
    }

    if (! empty($row['link']))
    {
        echo '</a>';
    }
}
echo '</div>';
echo '</section>';
