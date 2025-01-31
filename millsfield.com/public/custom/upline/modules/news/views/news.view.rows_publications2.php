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
	echo '<div class="articles-w__item">
			<a class="articles-w__img" href="'.BASE_PATH_HREF.$row["link"].'" itemscope itemtype="https://schema.org/ImageObject">';

			//вывод изображений новости
			if (! empty($row["img"]))
			{
				foreach ($row["img"] as $img)
				{
					echo '<meta itemprop="name" content="' . $img["title"] . '" />';
					echo '<img itemprop="contentUrl" src="'.$img["vs"]["catalog"].'" alt="'.$img["alt"].'" title="'.$img["title"].'">';
				}
			}

			echo '</a>
			<div class="articles-w__info">';

			//вывод названия новости
			if (! empty($row['name']))
			{
				echo '<h2 class="articles-w__title"><a href="'.BASE_PATH_HREF.$row["link"].'">'.$row["name"].'</a></h2>';
			}

			//вывод анонса новостей
			if(! empty($row["anons"]))
			{
				echo '<div class="articles-w__text">'.$row['anons'].'</div>';
			}

			echo '<a href="'.BASE_PATH_HREF.$row["link"].'" class="articles-w__link more">'; echo $this->diafan->_('list-what-is-it');
			echo '<SVG width="9" height="16" viewBox="0 0 9 16" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M1.16145 0.994812C1.06195 0.994836 0.96471 1.02455 0.882183 1.08015C0.799657 1.13574 0.735595 1.2147 0.698194 1.30691C0.660792 1.39912 0.651751 1.50039 0.67223 1.59777C0.692708 1.69515 0.741773 1.7842 0.813147 1.85354L6.95963 8.00002L0.813147 14.1465C0.765161 14.1926 0.726851 14.2478 0.70046 14.3088C0.674068 14.3699 0.660126 14.4356 0.65945 14.5021C0.658773 14.5686 0.671377 14.6346 0.696522 14.6962C0.721666 14.7578 0.758846 14.8138 0.805885 14.8608C0.852924 14.9078 0.908876 14.945 0.970464 14.9702C1.03205 14.9953 1.09804 15.0079 1.16456 15.0072C1.23108 15.0066 1.29679 14.9926 1.35786 14.9662C1.41892 14.9398 1.47411 14.9015 1.52018 14.8535L8.02018 8.35353C8.11391 8.25976 8.16656 8.13261 8.16656 8.00002C8.16656 7.86743 8.11391 7.74028 8.02018 7.6465L1.52018 1.1465C1.47357 1.09851 1.41781 1.06035 1.35619 1.0343C1.29457 1.00824 1.22835 0.994815 1.16145 0.994812Z" fill="#333333" stroke="#333333" stroke-width="0.5"></path>
				</SVG>
			</a>';
	echo '</div>
	</div>';
}

//Кнопка "Показать ещё"
//if(! empty($result["show_more"]))
//{
//	echo $result["show_more"];
//}
