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


echo '<section class="search-d'.($result['ajax'] ? ' ajax' : '').'">';
echo
	'<form class="search-d__form js_search_form search_form'.($result['ajax'] ? ' ajax" method="post"' : '" method="get"').' action="'.$result['action'].'">
	<div class="header__search-wrapper js-search-wrapper">
		<button class="header__search-btn btn js-search-btn">
		<svg class="header__search-svg" width="16" height="16">
			<use href="/assets/sprite.svg#search"></use>
		</svg>
		</button>
        <input class="header__search js-search" type="text" name="searchword" value="'.($result["value"] ? $result["value"] : '').'">
	</div>
	</form>';
	if($result['ajax'])
	{
		echo '<section class="search-d__result search_result js_search_result _scroll"></section>';
	}
	echo
'</section>';