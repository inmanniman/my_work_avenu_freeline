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

echo '<div class="docs-grid">';
foreach ($result as $i => $row)
{
    echo '<div class="item-wrap">';
	if (! empty($row['image']))
	{
        echo '<a href="' . $row['link'] . '" class="item"">';
        echo '<img src="'.(! empty($row['image']) ? BASE_PATH.USERFILES.'/bs/'.$row['image'] : '').'" alt="' . $row['alt'] . '" title="' . $row['title'] . '" loading="lazy" class="item_img">';
        echo '<div class="item-block">';
        echo ' <span class="item-btn">Читать далее</span>';
        echo '   </div>';
        echo ' </a>';

		echo '';
	}
    echo '</div>';
}
echo '</div>';
