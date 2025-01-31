<?php
/**
 * Шаблон блока файлов
 * 
 * Шаблонный тег <insert name="show_block" module="files" [count="количество"]
 * [cat_id="категория"] [site_id="страница_с_прикрепленным_модулем"]
 * [sort="порядок_вывода"] 
 * [images="количество_изображений"] [images_variation="тег_размера_изображений"]
 * [only_module="only_on_module_page"] [template="шаблон"]>:
 * блок файлов
 * 
 * @package    DIAFAN.CMS
 * @author     diafan.ru
 * @version    7.0
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

echo '<section class="block-d block-d_files block-d_files_item">';

//заголовок блока
if (! empty($result['name']))
{
	echo '<header class="block-d__name">'.$result['name'].'</header>';
}

//фaйлы
echo '<div class="block-d__list _list">';
echo $this->get($result['view_rows'], 'files', $result);
echo '</div>';

echo '</section>';
