<?php
/**
 * Шаблон блока похожих товаров
 *
 * Шаблонный тег <insert name="show_block_rel" module="shop" [count="количество"]
 * [images="количество_изображений"] [images_variation="тег_размера_изображений"]
 * [template="шаблон"]>:
 * блок похожих товаров
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

if(empty($result['rows'])) return false;
?>
<div class="materials">
    <div class="s-title">Дополнительные материалы:</div>
    <div class="materials-slider-wrap"><?= $this->get($result["view_rows"] . '_rel_custom','shop',$result) ?></div>
</div>

