<?php
/**
 * Шаблон первой страницы модуля, если в настройках модуля подключен параметр «Использовать категории»
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

if (empty($result["categories"]))
	return false;


?>
<div class="prod-grid">
<?php foreach($result["categories"] as $child){
	if(!empty($child["img"])){?>
    <div class="item-wrap">
        <a href="<?= BASE_PATH_HREF . $child["link_all"] ?>" class="item">
            <img src="<?= BASE_PATH . $child['img'][0]['src'] ?>" alt="" title="" loading="lazy" class="item_img">
            <div class="item-block">
                <div class="item-title"><?= $child['name'] ?></div>
                <div class="item-text"><?= $child['anons'] ?></div>
                <span class="item-btn">Смотреть товары</span>
            </div>
        </a>
    </div>
	<?php } ?>
<?php } ?>
</div>
<?php

//Кнопка "Показать ещё"
if(! empty($result["show_more"]))
{
	echo $result["show_more"];
}

//постраничная навигация
if(! empty($result["paginator"]))
{
	echo $result["paginator"];
}
