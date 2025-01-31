<?php
/**
 * Шаблон первой страницы модуля, если в настройках модуля подключен параметр «Использовать категории»
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

//print_r($result['categories'][0]['img']);

if (empty($result["categories"]))
    return false;

echo '<div class="container">';
echo '<h1>Каталог</h1>';
echo '<div class="catalog-list">';

//начало большого цикла, вывод категорий и товаров в них
foreach ($result["categories"] as $cat_id => $cat) {
    echo '<a href="' . BASE_PATH_HREF . $cat["link_all"] . '" class="catalog-list__item">';
    echo '<img class="catalog-list__bg" src="/custom/upline/images/bg-category.svg" width="610" height="327" alt="">';
    //вывод изображений категории
    if (!empty($cat["img"])) {
        foreach ($cat["img"] as $img) {
            echo '<img class="catalog-list__img" src="' . $img["vs"]["medium"] . '" srcset="' . $img["vs"]["large"] . ' 2x"  width="610" height="327" alt="' . $img["alt"] . '" title="' . $img["title"] . '">';
        }
    }

    //вывод названия категории
    echo '<div class="catalog-list__wrapper">';
    echo '<sapn class="catalog-list__name">' . $cat["name"] . '</sapn>';
    echo '<span class="catalog-list__btn"><svg class="catalog__box-btn-svg" width="20" height="17" viewBox="0 0 20 17" xmlns="http://www.w3.org/2000/svg"><use href="/assets/sprite.svg#arrow-left"></use></svg></span>';
    echo '</div>';

    echo '</a>';
}

//Кнопка "Показать ещё"
if (!empty($result["show_more"])) {
    echo $result["show_more"];
}

//постраничная навигация
if (!empty($result["paginator"])) {
    echo $result["paginator"];
}

echo '</div>';
echo '</div>';
