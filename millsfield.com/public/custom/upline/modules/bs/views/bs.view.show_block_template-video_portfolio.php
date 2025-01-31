<?php
/**
 * Шаблон блока баннеров
 * 
 * Шаблонный тег <insert name="show_block" module="bs" [count="all|количество"]
 * [cat_id="категория"] [id="номер_баннера"] [template="шаблон"]>:
 * блок баннеров
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



if (empty($result))
{
	return false;
}               



echo '<section class="video-portfolio">';

foreach ($result as $row) 
{

    //вывод баннера в виде изображения
    if (! empty($row['image']))
    {	echo '<div class="video-portfolio__item">';
		if (! empty($row['name'])) 
		{
			echo '<h2>' .$row['name'] .'</h2>';
		}

        echo '<a width="560" height="315" href="https://www.youtube.com/embed/'.$this->htmleditor($row['link']).'" class="frame-video" data-fancybox="video-portfolio">';
        
		echo '<img width="825" height="370" loading="lazy" class="frame-video__img" src="'.BASE_PATH.USERFILES.'/bs/'.$row['image'] .'" alt="'.(! empty($row['alt']) ? $row['alt'] : '').'" title="'.(! empty($row['title']) ? $row['title'] : '').'">';
        
		echo '</a></div>';
    }
}

echo '</section>';


//постраничная навигация
if(! empty($result["paginator"]))
{
	echo $result["paginator"];
}