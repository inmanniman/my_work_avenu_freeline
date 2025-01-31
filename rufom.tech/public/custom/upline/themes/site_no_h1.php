<?php
/**
 * Основной шаблон сайта
 *
 * @package    DIAFAN.CMS
 * @author     diafan.ru
 * @version    6.0
 * @license    http://www.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2018 OOO «Диафан» (http://www.diafan.ru/)
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
<insert name="show_include" file="head"></insert>


<body class="page">
<div class="page__wrap">
    <insert name="show_include" file="header"></insert>
  <div class="inner">
    <div class="container">
        <insert name="show_breadcrumb" current="true"></insert>
      <div class="content">
      <insert name="show_text"></insert>
      </div>
      <insert name="show_module"></insert>
    </div>
  </div>

 <insert name="show_include" file="footer"></insert>
</div>
 <insert name="show_include" file="foot"></insert>


</body>
</html>
