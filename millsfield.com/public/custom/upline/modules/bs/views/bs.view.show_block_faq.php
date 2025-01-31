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

echo '<h2 class="infoForm__title">' .$this->diafan->_('title_faq') .'</h2>
<div class="tabs">';

foreach ($result as $row) {

    if (! empty($row['name']))
    {
        echo '<div class="tabs__item">
                <div class="tabs__nav">' .$row['name'] .'</div>
                <div class="tabs__content">' .$row['text'] .'</div>
                <hr>
            </div>';
    }
}

echo '</div>';