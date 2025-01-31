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

echo '<section class="proposal">';
echo '<div class="proposal__block container">';

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
        echo '<div class="proposal__img-wrapper proposal__img-wrapper_service">';
		    echo '<img class="proposal__human proposal__human_service" loading="lazy" src="'.BASE_PATH.USERFILES.'/bs/'.$row['image'].'" alt="'.(! empty($row['alt']) ? $row['alt'] : '').'" title="'.(! empty($row['title']) ? $row['title'] : '').'">';
        echo '</div>';
	}

    if (! empty($row['text']))
    {
        echo '<div class="proposal__wrapper-content">';
            echo '<ul class="proposal__txt">
                    <li class="proposal__title">'.$row['name'].'</li>
                    <li class="proposal__desc">'.$row['alt'].'</li>
                    <li class="proposal__desc">'.$row['title'].'</li>
                  </ul>
            <a href="/" class="proposal__btn"><span class="proposal__btn-txt">'.strip_tags($row['text']).'</span></a>';
        echo '</div>';
    }

	if (! empty($row['link']))
	{
		echo '</a>';
	}
}
echo '</div>';
echo '</section>';
