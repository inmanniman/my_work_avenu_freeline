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
 * @version    6.0
 * @license    http://www.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2018 OOO «Диафан» (http://www.diafan.ru/)
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

if (empty($result["rows"][0])) {
    return false;
}
/*echo '<div class="block_header">'.$this->diafan->_('Категории').'</div>';*/

echo '<div class="prod-grid">';

//вывод категорий
foreach ($result["rows"][0] as $row) {
    if (!empty($row["img"])) {
        echo '<div class="item-wrap">';

        //изображения категорий
        foreach ($row["img"] as $img) {
            echo '<a href="' . BASE_PATH_HREF . $row["link"] . '" class="item">';
            echo '<img src="' . $img["src"] . '" class="item__img" alt="' . $img["alt"] . '" title="' . $img["title"] . '" loading="lazy" width="360" height="240">';
        }
        echo '<div class="item-block">';
        //название и ссылка категории
        echo '<div class="item-title">' . $row["name"];
        if (isset($row["number_elements"])) {
            echo ' (' . $row["number_elements"] . ')';
        }
        echo '</div>';

        //описание категории
        if (!empty($row["anons"])) {
            echo '<div class="item-text">';
            echo $row['anons'];
            echo '</div>';
        }

        echo '<span class="item-btn">Смотреть товары</span>';
        echo '</div>';
        echo '</a>';
        echo '</div>';
    }
}
echo '</div>';
