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


echo '<li class="'.($result['ajax'] ? 'ajax' : '').'">';
echo
'<form action="'.$result["action"].'" class="'.($result["ajax"] ? 'ajax" method="post"' : '" method="get"').'>
    <button class="header__burger btn js-m-menu-btn-open">
	<svg width="28" height="18">
		<use href="/assets/sprite.svg#burger"></use>
	</svg>
	</button>
</form>';
if($result["ajax"])
{
	echo '<section class="search-d__result search_result js_search_result"></section>';
}
echo '</li>';