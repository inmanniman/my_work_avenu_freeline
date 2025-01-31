<?php
/**
 * Шаблон списка товаров
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

if(! empty($result["error"]))
{
	echo '<p>'.$result["error"].'</p>';
	return;
}

if(empty($result["ajax"]))
{
	echo '<div class="js_shop_list shop_list">';
}

//вывод описания текущей категории

?>
<?php if($result["children"]){ ?>
<div class="prod-grid">
<?php foreach($result["children"] as $child){
	if(!empty($child["img"])){?>
    <div class="item-wrap">
        <a href="<?= BASE_PATH_HREF . $child['link'] ?>" class="item">
            <img src="<?= BASE_PATH . $child['img'][0]['src'] ?>" srcset="<?= BASE_PATH . $child['img'][0]['vs']['cat_big'] ?> 2x" alt="<?= $child['name'] ?>" title="<?= $child['name'] ?>" width="360" height="240" loading="lazy" class="item_img">
            <div class="item-block">
                <div class="item-title"><?= $child['name'] ?></div>
                <div class="item-text"><?= $child['anons'] ?></div>
                <span class="item-btn">Узнать больше</span>
            </div>
        </a>
    </div>
	<?php } ?>
<?php } ?>
</div>
<?php } ?>
<?php
//вывод списка товаров
if(! empty($result["rows"]))
{
	echo $this->get($result["view_rows"], 'shop', $result);
}

//постраничная навигация
if(! empty($result["paginator"]))
{
	echo $result["paginator"];
}


if(! empty($result["text"]))
{
	echo '<div class="content">';
	echo $result['text'].'</div>';
}

//вывод комментариев ко всей категории товаров (комментарии к конкретному товару в функции id())
if(! empty($result["comments"]))
{
	echo $result["comments"];
}

if(empty($result["ajax"]))
{
	echo '</div>';
}
