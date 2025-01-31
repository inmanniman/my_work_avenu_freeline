<?php
/**
 * Шаблон блока категорий
 *
 * Шаблонный тег <insert name="show_category" module="shop"
 * [site_id="страница_с_прикрепленным_модулем"]
 * [images="количество_изображений"] [images_variation="тег_размера_изображений"]
 * [count_level="количество_уровней"] [number_elements="выводить_количество_товаров_в_категории:true|false"]
 * [only_module="true|false"]
 * [template="шаблон"]>:
 * блок категорий
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



if (empty($result["rows"][0]))
{
	return false;
}


echo '<section class="catalog">';

//echo '<header class="block-d__name">'.$this->diafan->_('Категории').'</header>';

//вывод категорий
echo '<div class="catalog__wrapper-content"><div class="catalog__wrapper-boxs">';
foreach ($result["rows"][0] as $row)
{

//print_r($row);

    //название и ссылка категории
    echo '<div class="catalog__box-text">';
        echo '<span class="catalog__title">'.$row["name"].'</span>';
        echo $row['anons'];
    echo '</div>';


	//описание категории
	//if(! empty($row["anons"]))
	//{
	//	echo '<div class="detail-d detail-d_anons _text">'.$row['anons'].'</div>';
	//}

//	echo '<div class="element-d__list element-d__list_children _list">';
	if(! empty($result["rows"][$row["id"]]))
	{
		$res = $result;
		$res["level"] = 2;
		$res["parent_id"] = $row["id"];

		echo $this->get('show_category_level', 'shop', $res);
	}
//	echo '</div>';
}
echo '</div></div>';
echo '</section>';
