<?php
/**
 * Шаблон блока комментариев
 * 
 * Шаблонный тег <insert name="show_block" module="comments" [count="количество"]
 * [element_id="элементы"] [modules="модули"]
 * [sort="порядок_вывода"] [template="шаблон"]>:
 * блок комментариев
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



if(empty($result['rows'])) return false;

echo '<section class="block-d block-d_comments block-d_comments_item">';

echo '<header class="block-d__name">'.$this->diafan->_('Последние комментарии').'</header>';

//комментарии
echo '<div class="block-d__list _list">';
echo $this->get($result['view_rows'], 'comments', $result);
echo '</div>';

echo '</section>';