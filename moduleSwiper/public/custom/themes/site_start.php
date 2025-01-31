<?php
/**
 * Шаблон страницы сайта, назначенной по умолчанию как стартовая для сайта
 *
 * @package    DIAFAN.CMS
 * @author     diafan.ru
 * @version    7.0
 * @license    http://www.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2020 OOO «Диафан» (http://www.diafan.ru/)
 */

if(! defined("DIAFAN"))
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
?>

<!DOCTYPE HTML>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <meta name="description" content="A page for exploring basic HTML documents">
  <link href="/assets/css/app.css?v=5" rel="stylesheet"/>
    <script defer src="/assets/js/app.js?v=5"></script> 
  <title>Basic HTML document</title>
  </head>
  <body>
    <insert name="show_block" module="swiper" template="news-photo" count="10" cat_id="1">
  </body>
</html>
