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

if (!defined('DIAFAN')) {
    $path = __FILE__;
    while (!file_exists($path . '/includes/404.php')) {
        $parent = dirname($path);
        if ($parent == $path) exit;
        $path = $parent;
    }
    include $path . '/includes/404.php';
}

if (empty($result)) {
    return false;
}
if (!isset($GLOBALS['include_bs_js'])) {
    $GLOBALS['include_bs_js'] = true;
    //скрытая форма для отправки статистики по кликам
    //action=""
    echo '<form method="POST" enctype="multipart/form-data" class="ajax js_bs_form bs_form">
	<input type="hidden" name="module" value="bs">
	<input type="hidden" name="action" value="click">
	<input type="hidden" name="banner_id" value="0">
	</form>';
}

foreach ($result as $i => $row) {
    echo '<section class="rubber-gaskets" style="background-image: url(' . BASE_PATH . USERFILES . '/bs/' . $row['image'] . '")>';
    //вывод баннера в виде html разметки
    if (!empty($row['text'])) {
        echo '<div class="rubber-gaskets__wrapper-content container">';
        echo '<h1 class="rubber-gaskets__title base-title">' . $row['name'] . '</h1>';

        echo $row['text'];

        echo '<button class="rubber-gaskets__btn base-button base-button_type_light" href="#request_modal" data-fancybox>Консультация</button>';

        echo '</div>';
    }
    //вывод баннера в виде изображения
    if (!empty($row['image'])) {
        echo '<div class="rubber-gaskets__wrapper-img">';
        echo '<img width="686" height="466" class="rubber-gaskets__img" src="' . BASE_PATH . USERFILES . '/bs/' . $row['image'] . '" alt="' . (!empty($row['alt']) ? $row['alt'] : '') . '" title="' . (!empty($row['title']) ? $row['title'] : '') . '">';
        echo '</div>';
    }
}
echo '</section>';
