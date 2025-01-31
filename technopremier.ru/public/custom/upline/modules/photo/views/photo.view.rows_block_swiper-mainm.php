<?php
/**
 * Шаблон элементов в списке фотографий
 *
 * @package    DIAFAN.CMS
 * @author     diafan.ru
 * @version    7.0
 * @license    http://www.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2014 OOO «Диафан» (http://diafan.ru)
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

//вывод списка фотографий
if (empty($result["rows"])) return false;
foreach ($result["rows"] as $row) 
{
    //вывод маленького изображения
    if (!empty($row["img"])) 
    {
        echo '<div class="swiper-slide main-swiper_swiper-slide">';
        $link = $row["img"]["title"];
        echo $this->htmleditor('<insert name="show_dynamic" id="3" module="site">');
        if (!empty($link)) {
            echo '<a href="' . $link . '" class="main-swiper_swiper-link">';
        } else {
            echo '<div class="main-swiper_swiper-link">';
        }
        echo '<img
				class="main-swiper__img"
				srcset="' . $row["img"]["vs"]["medium"] . ' 2x"
				src="' . $row["img"]["vs"]["390_295"] . '"
				alt="' . $row["img"]["alt"] . '">';

        //вывод краткого описания фотографии
        if (!empty($row["anons"])) {
            echo $row['anons'];
        }
        if (!empty($link)) {
            echo '</a>';
        } else {
            echo '</div>';
        }
        echo '</div>';
    }
}

//Кнопка "Показать ещё"
//if(! empty($result["show_more"]))
//{
//	echo $result["show_more"];
//}

