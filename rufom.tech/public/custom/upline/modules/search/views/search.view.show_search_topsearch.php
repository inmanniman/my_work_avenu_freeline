<?php
/**
 * Шаблон формы поиска по сайту, template=top
 *
 * Шаблонный тег <insert name="show_search" module="search" template="top"
 * [button="надпись на кнопке"]>:
 * форма поиска по сайту
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
 
echo '
	<form action="'.$result["action"].'" class="form search js_search_form search_form'.($result["ajax"] ? ' ajax" method="post"' : '" method="get"').' id="search">
	<input type="hidden" name="module" value="search">
	<input id="textbox" class="form-input" type="search" name="searchword" placeholder="'.$this->diafan->_('Что ищем?', false).'" value="'.($result["value"] ? $result["value"] : '').'"> 
	</form>';
if($result["ajax"])
{
	echo '<div class="js_search_result search_result"></div>';
}