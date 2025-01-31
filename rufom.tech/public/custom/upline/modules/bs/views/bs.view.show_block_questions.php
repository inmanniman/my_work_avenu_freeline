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
echo '<section id="questions-and-answers" class="delivery-and-questions container">';
echo '<h3 class="delivery-and-questions__title delivery-and-questions__title_center base-title">Вопросы и ответы</h3>';
echo '<div class="delivery-and-questions__wrapper-block">';
foreach ($result as $i => $row)
{
    echo '<details class="delivery-and-questions__block">';
        //вывод баннера в виде изображения

        //вывод баннера в виде html разметки
        if (! empty($row['name'])){
            echo '<summary class="delivery-and-questions__summary">';
            echo '<div class="delivery-and-questions__txt">' . $row['name'] . '</div>';
            echo '</summary>';
        }
        if (! empty($row['text']))
        {
            echo '<div class="delivery-and-questions__desc">';
            echo $row['text'];
            echo '</div>';
        }
    echo '</details>';
}
echo '</div>';
echo '<button class="delivery-and-questions__btn base-button base-button_type_secondary" data-fancybox
                  data-src="#feedback_modal">Задать
              вопрос</button>';
echo '</section>';
