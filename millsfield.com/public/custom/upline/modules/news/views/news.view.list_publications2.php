<?php
/**
 * Шаблон список новостей
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


echo '<div class="articles-w">
		<div class="articles-w__inner">';

//вывод списка новостей
if(! empty($result["rows"]))
{
	echo $this->get($result["view_rows"], 'news', $result);
}

echo '</div>
	</div>';

//вывод постраничная навигация в конце списка новостей
if(! empty($result["paginator"]))
{
echo $result["paginator"];
}