<?php
/**
 * Шаблон изображений к странице сайта
 *
 * Шаблонный тег <insert name="show_images" module="site" [template="шаблон"]>:
 * выводит изображения, прикрепленные к старинце сайта
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



if (empty($result["images"]))
{
	return;
}

 if (! empty($result["images"][0]['src']))
 {
	echo '<section class="front section-mg18 main" style="background-image: url(' . $result["images"][0]['src'] . ');">';	 
 }
 else
 {
	echo '<section class="front section-mg18 main">';	 
 }

echo '<div class="container">
		<div class="front__inner">';

			if ($this->htmleditor('<insert name="show_dynamic" module="site" id="2">'))
			{
				echo $this->htmleditor('<insert name="show_dynamic" module="site" id="2" template="easy">');
			}
			else
			{
				echo '<h1 class="front__title">';
				echo $this->htmleditor('<insert name="show_h1">');
				echo '</h1>';
			}
				
			if ($this->htmleditor('<insert name="show_dynamic" module="site" id="5">'))
			{
				echo '<div class="front__discrip">';
				echo $this->htmleditor('<insert name="show_dynamic" module="site" id="5" template="easy">');
				echo '</div>';
			}

		echo '</div>
    </div>
</section>';