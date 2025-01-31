<?php
/**
 * Шаблон списка товаров
 *
 * @package    DIAFAN.CMS
 * @author     diafan.ru
 * @version    7.0
 * @license    http://www.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2021 OOO «Диафан» (http://www.diafan.ru/)
 */

if (!defined('DIAFAN')) {
    $path = __FILE__;
    while (!file_exists($path . '/includes/404.php')) {
        $parent = dirname($path);
        if ($parent == $path) exit;
        $path = $parent;
    }
    include $path . '/includes/404.php';
}


if (!empty($result["error"])) {
    echo '<p class="_note">' . $result["error"] . '</p>';
    return;
}

//if(empty($result["ajax"]))
//{
//	echo '<section class="section-d section-d_list section-d_shop section-d_shop_cat shop_list js_shop_list">';
//}

echo '<section class="rent-excavators" id="mode">';

//вывод изображений текущей категории

echo '<div class="rent-excavators__wrapper-title container">';
echo '<h1 class="rent-excavators__title">' . $result["name"] . '</h1>';
echo '</div>';

//if(! empty($result["img"]))
//{
//	echo '<div class="_images">';
//	foreach($result["img"] as $img)
//	{
//		switch ($img["type"])
//		{
//			case 'animation':
//				echo '<a href="'.BASE_PATH.$img["link"].'" data-fancybox="gallery'.$result["id"].'shop_cat">';
//				break;
//			case 'large_image':
//				echo '<a href="'.BASE_PATH.$img["link"].'" rel="large_image" width="'.$img["link_width"].'" height="'.$img["link_height"].'">';
//				break;
//			default:
//				echo '<a href="'.BASE_PATH_HREF.$img["link"].'">';
//				break;
//		}
//		if($img["source"])
//		{
//			echo $img["source"];
//		}
//		else
//		{
//			echo '<img src="'.$img["src"].'" width="'.$img["width"].'" height="'.$img["height"].'" alt="'.$img["alt"].'" title="'.$img["title"].'">';
//		}
//		echo '</a> ';
//	}
//	echo '</div>';
//}
//
//if(! empty($result['text']))
//{
//	echo '<div class="_text">'.$result['text'].'</div>';
//}

//вывод подкатегории
if (!empty($result["children"])) {
    echo '<div class="container">';
    echo '<div class="rent-excavators__filter">';
    foreach ($result["children"] as $child) {

        //название и ссылка подкатегории
        echo '<a href="' . BASE_PATH_HREF . $child["link"] . '" class="rent-excavators__full-filter rent-excavators__all-filter">' . $child["name"] . '</a>';

    }
    echo '</div>';
    echo '</div>';
}

//вывод списка товаров
if (!empty($result["rows"])) {
    //вывод сортировки товаров
//    if (!empty($result["link_sort"])) {
//        echo $this->get('sort_block', 'shop', $result);
//    }
//
//    $view = '_viewgrid';
//    if (!empty($_COOKIE['_diafan_shop_view'])) {
//        switch ($_COOKIE['_diafan_shop_view']) {
//            case 'rows':
//                $view = '_viewrows';
//                break;
//        }
//    }

    echo '<div class="container">';
    echo '<div class="rent-excavators__content">';
    echo $this->get($result["view_rows"], 'shop', $result);
    echo '</div>';
    echo '</div>';
}

//постраничная навигация
if (!empty($result["paginator"])) {
    echo $result["paginator"];
}


echo '</section>';

//if(empty($result["ajax"]))
//{
//	echo '</section>';
//}
