<?php
/**
 * Шаблон блока похожих файлов
 * 
 * Шаблонный тег <insert name="show_block_rel" module="files" [count="количество"]
 * [images="количество_изображений"] [images_variation="тег_размера_изображений"]
 * [template="шаблон"]>:
 * блок похожих файлов
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

echo '<section class="block-d block-d_files block-d_files_item block-d_files_item_rel">';

echo '<header class="block-d__name">'.$this->diafan->_('Похожие файлы').'</header>';

//заголовок блока
if (! empty($result["name"]))
{
	echo '<header class="block-d__name">'.$result["name"].'</header>';
}

//фaйлы
echo '<div class="block-d_list _list">';
echo $this->get($result["view_rows"], 'files', $result);
echo '</div>';

echo '</section>';
