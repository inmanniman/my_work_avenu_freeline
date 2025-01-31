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

echo '<div class="interior-electrical">';

foreach ($result as $row) {

    //вывод баннера в виде изображения
    if (! empty($row['image']))
    {
        echo '<div class="interior-electrical__item">

            <img class="interior-electrical__img" src="'.BASE_PATH.USERFILES.'/bs/'.$row['image'].'" alt="'.(! empty($row['alt']) ? $row['alt'] : '').'" title="'.(! empty($row['title']) ? $row['title'] : '').'">';
        
            
            echo '<div class="interior-electrical__description">';
            if (! empty($row['name']))
            {
                echo '<div>' .$row['name'] .'</div>';
            }
            echo '<a class="interior-electrical__order" data-fancybox data-src="#modal_request">Заказать услуги</a>
            </div>';

        echo '</div>';
    }
}

echo '</div>';