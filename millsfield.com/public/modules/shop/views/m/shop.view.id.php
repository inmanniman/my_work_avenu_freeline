<?php
/**
 * Шаблон страницы товара
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

echo '<div class="js_shop_id js_shop shop-item-container is_mobile">';


echo '<div class="shop-item-left">';

//вывод изображений товара
if(! empty($result["img"]))
{
	echo '<div class="js_shop_all_img shop_all_img shop-item-big-images">';
	$k = 0;
	foreach($result["img"] as $img)
	{
		switch ($img["type"])
		{
			case 'animation':
				echo '<a class="js_shop_img shop-item-image '.(empty($k) ? 'active' : '').'" href="'.BASE_PATH.$img["link"].'" data-fancybox="gallery'.$result["id"].'shop" style="background-image:url('.BASE_PATH.$img["link"].')" image_id="'.$img["id"].'">';
				break;
			case 'large_image':
				echo '<a class="js_shop_img shop-item-image '.(empty($k) ? 'active' : '').'" href="'.BASE_PATH.$img["link"].'" rel="large_image" width="'.$img["link_width"].'" height="'.$img["link_height"].'" style="background-image:url('.BASE_PATH.$img["link"].')" image_id="'.$img["id"].'">';
				break;
			default:
				echo '<a class="js_shop_img shop-item-image '.(empty($k) ? 'active' : '').'" href="'.BASE_PATH_HREF.$img["link"].'" style="background-image:url('.BASE_PATH_HREF.$img["link"].')" image_id="'.$img["id"].'">';
				break;
		}
		echo '<img src="'.$img["src"].'" width="'.$img["width"].'" height="'.$img["height"].'" alt="'.$img["alt"].'" title="'.$img["title"].'" image_id="'.$img["id"].'">';
		echo '</a>';
		$k++;
	}
	echo '<span class="shop-photo-labels">';
		if(! empty($result['hit']))
		{
			echo '<img src="' . BASE_PATH . Custom::path('img/label_hot_big.png').'"/>';
		}
		if(! empty($result['action']))
		{
			echo '<img src="' . BASE_PATH . Custom::path('img/label_special_big.png').'"/>';
		}
		if(! empty($result['new']))
		{
			echo '<img src="' . BASE_PATH . Custom::path('img/label_new_big.png').'"/>';
		}
	echo '</span>';

	echo '<span class="icon-zoom">&nbsp;</span>
	<span class="js_shop_wishlist shop_wishlist shop-like'.(! empty($result["wish"]) ? ' active' : '').'"><i class="fa fa-heart'.(! empty($result["wish"]) ? '' : '-o').'">&nbsp;</i></span>';

	echo '</div>';
	if($result["preview_images"] && count($result["img"]) > 1)
	{
		echo '<a class="control-prev shop-previews-control" href="#">&nbsp;</a>
	          <a class="control-next shop-previews-control" href="#">&nbsp;</a>';
		echo '<div class="shop_preview_img shop-item-previews items-scroller" data-item-per-screen="3" data-controls="shop-previews-control">';
		foreach($result["img"] as $img)
		{
			echo ' <a class="js_shop_preview_img item" href="#" style="background-image:url('.$img["preview"].')" image_id="'.$img["id"].'">&nbsp;</a>';
		}
		echo '</div>';
	}
}

echo '</div>';

echo '<div class="shop-item-right">';
	echo '<div class="shop-item-info1">';

		//вывод артикула
		if(! empty($result["article"]))
		{
			echo '<h4 class="shop-item-artikul">'.$this->diafan->_('Артикул').': '.$result["article"].'</h4>';
		}

		//вывод производителя
		if(! empty($result["brand"]))
		{
			echo '<div class="shop_brand">';
			echo $this->diafan->_('Производитель').': ';
			echo '<a href="'.BASE_PATH_HREF.$result["brand"]["link"].'">'.$result["brand"]["name"].'</a>';
			echo '</div>';
		}

		//вывод рейтинга товара
		if(! empty($result["rating"]))
		{
			echo '<div class="shop-item-rate rate">' . $this->diafan->_('Рейтинг').": ";
			echo $result["rating"];
			echo '</div>';
		}

		//скидка на товар
		if(! empty($result["discount"]))
		{
			echo '<div class="shop_discount">'.$this->diafan->_('Скидка').': <span class="shop_discount_value">'.$result["discount"].' '.$result["discount_currency"].($result["discount_finish"] ? ' ('.$this->diafan->_('до').' '.$result["discount_finish"].')' : '').'</span></div>';
		}

		//кнопка "Купить"
		echo $this->get('buy_form', 'shop', array("row" => $result, "result" => $result));

		if(empty($result["hide_compare"]))
		{
		    echo $this->get('compare_form', 'shop', $result);
		    //echo $this->get('compared_goods_list', 'shop', array("site_id" => $result["site_id"], "shop_link" => $result['shop_link']));
		}

		if(! empty($result["weight"]))
		{
			echo '<div class="shop_weight">'.$this->diafan->_('Вес').': '.$result["weight"].'</div>';
		}
		if(! empty($result["length"]))
		{
			echo '<div class="length">'.$this->diafan->_('Длина').': '.$result["length"].'</div>';
		}
		if(! empty($result["width"]))
		{
			echo '<div class="shop_width">'.$this->diafan->_('Ширина').': '.$result["width"].'</div>';
		}
		if(! empty($result["height"]))
		{
			echo '<div class="shop_height">'.$this->diafan->_('Высота').': '.$result["height"].'</div>';
		}

        echo $this->htmleditor('<insert name="show_social_links">');

	echo '</div>';

echo '</div>';

//счетчик просмотров
if(! empty($result["counter"]))
{
	echo '<div class="shop_counter">'.$this->diafan->_('Просмотров').': '.$result["counter"].'</div>';
}

//теги товара
if(! empty($result["tags"]))
{
	echo $result["tags"];
}

//полное описание товара
echo '<div class="shop_text">'.$result['text'].'</div>';


echo '<div class="shop-item-info2">';

    echo $this->htmleditor('<insert name="show_theme" module="site" tag="delivery">');
    echo $this->htmleditor('<insert name="show_theme" module="site" tag="return">');

echo '</div>';
//характеристики товара
if(! empty($result["param"]))
{
	echo $this->get('param', 'shop', array("rows" => $result["param"], "id" => $result["id"]));
}

//комментарии к товару
if(! empty($result["comments"]))
{
	echo $result["comments"];
}

echo '</div>';

echo $this->htmleditor('<insert name="show_block_order_rel" module="shop" count="2" images="1">');

echo $this->htmleditor('<insert name="show_block_rel" module="shop" count="2" images="1">');
