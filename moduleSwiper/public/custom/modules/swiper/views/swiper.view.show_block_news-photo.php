<?php
/**
 * Шаблон блока фотографий
 *
 * Шаблонный тег <insert name="show_block" module="swiper" [count="количество"]
 * [cat_id="категория"] [site_id="страница_с_прикрепленным_модулем"]
 * [sort="порядок_вывода"]
 * [images_variation="тег_размера_изображений"]
 * [only_module="only_on_module_page"] [template="шаблон"]>:
 * блок фотографий
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

print_r($result);

$directory = __DIR__;
$createSwiperPath = dirname($directory) . '/js/createSwiper.php';

// Start buffering output
ob_start();
include $createSwiperPath;
// Get the buffered output
$output = ob_get_clean();

// Write the output to createSwiper.js
$createSwiperJSPath = dirname(dirname(dirname(dirname(dirname($directory))))) . '/assets/js/swiper.js';
file_put_contents($createSwiperJSPath, $output);

if(empty($result["rows"])) return false;
echo $this->get($result['view_rows'] . '_news-photo', 'swiper', $result);
