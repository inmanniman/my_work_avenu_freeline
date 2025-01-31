<?php
/**
 * Шаблон элементов в списке новостей
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

//вывод списка новостей
foreach ($result["rows"] as $row)
{		           
	echo '<a class="articles-v2__item" href="'.BASE_PATH_HREF.$row["link"].'">';
	
	//вывод изображений новости
	if (! empty($row["img"]))
	{
		foreach ($row["img"] as $img)
		{
			echo '<span class="articles-v2__img" itemscope itemtype="https://schema.org/ImageObject">
			<meta itemprop="name" content="' . $img["title"] . '" />
			<img itemprop="contentUrl" src="'.$img["vs"]["catalog"].'" alt="'.$img["alt"].'" title="'.$img["title"].'">'
			.'</span>';
		}
	}
	
	//вывод названия новости
    if (! empty($row['name']))
    {
		echo '<span class="articles-v2__title">'.$row["name"].'</span>';
    }

	//вывод анонса новостей
	if(! empty($row["anons"]))
	{
		echo '<span class="articles-v2__info">'.$row['anons'].'</span>';
	}

    //вывод даты новости
    if (! empty($row['date']))
    {
        echo '<span class="articles-v2__date">'.$row["date"].'</span>';
    }
	echo '</a>';

}

//Кнопка "Показать ещё"
//if(! empty($result["show_more"]))
//{
//	echo $result["show_more"];
//}
