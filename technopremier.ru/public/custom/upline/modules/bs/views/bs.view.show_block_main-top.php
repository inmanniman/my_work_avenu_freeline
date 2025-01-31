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

//<section class="choice-of-equipment">
//      <div class="container">
//        <div class="choice-of-equipment__wrapper-content">
//          <span class="choice-of-equipment__title">
//            <span class="choice-of-equipment__title_bold">ВЫБИРАЙ ЛУЧШУЮ ТЕХНИКУ</span>
//НА ВЫГОДНЫХ УСЛОВИЯХ
//</span>
//          <span class="choice-of-equipment__subtitle">только у проверенного дистрибьютера</span>
//        </div>
//      </div>
//    </section>

//echo '<section class="choice-of-equipment" style="  background: url("~/images/background-choise-equ.png") no-repeat center;background-size: 100% 100%;"><div class="container">';

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
        echo '<section class="choice-of-equipment" style="background-image: url('.BASE_PATH.USERFILES.'/bs/'.$row['image'].');">'.
            '<div class="container">'.'<div class="choice-of-equipment__wrapper-content">'.(! empty($row['text']) ? $row['text'] : '');
    }

	if (! empty($row['link']))
	{
		echo '</a>';
	}
}
echo '</div></div></section>';
