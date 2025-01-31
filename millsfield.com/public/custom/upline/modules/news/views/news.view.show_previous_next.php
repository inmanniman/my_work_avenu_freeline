<?php
/**
 * Шаблон ссылок на предыдущую и следующую страницы сайта
 *
 * Шаблонный тег <insert name="show_previous_next" module="news" [template="шаблон"]>:
 * выводит ссылки на предыдующую и следующую страницы
 * 
 * @package    DIAFAN.CMS
 * @author     diafan.ru
 * @version    7.0
 * @license    http://www.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2020 OOO «Диафан» (http://www.diafan.ru/)
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



if (empty($result["previous"]) && empty($result["next"]))
{
	return;
}

echo '<div class="prevnext-d news-prev-next">';
if(! empty($result["previous"]))
{
	echo '<a class="prevnext-d__prev" href="'.BASE_PATH_HREF.$result["previous"]["link"].'"><- '. $this->diafan->_('prev-article-link') .'</a>';
}
if(! empty($result["next"]))
{
	echo '<a class="prevnext-d__next" href="'.BASE_PATH_HREF.$result["next"]["link"].'">'. $this->diafan->_('next-article-link') .' -></a>';
}
echo '</div>';
