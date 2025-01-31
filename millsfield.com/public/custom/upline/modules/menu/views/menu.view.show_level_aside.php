<?php
/**
 * Шаблон вывода первого уровня меню, вызывается из функции show_block в начале файла, template=topmenu
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

if (empty($result["rows"][$result["parent_id"]]))
{
    return;
}

// print_r($result["rows"]);


// начало уровня меню
foreach ($result["rows"][$result["parent_id"]] as $row)
{
	if ($row["active"])
	{
		// начало пункта меню для текущей страницы
		echo '<li class="aside-nav__item aside-nav__item-current active">';
	}
	elseif ($row["active_child"])
	{
		// начало пункта меню для активного дочернего пункта
		echo ' <li class="aside-nav__item parent active">';
	}
	elseif ($row["children"])
	{
		// начало пункта меню для элемента -родителя
		echo ' <li class="aside-nav__item parent">';
	}
	else
	{
		// начало любого другого пункта меню
		echo '<li class="aside-nav__item">';
	}

	
	if (
		// на текущей странице нет ссылки, если не включена настройка "Текущий пункт как ссылка"
		(!$row["active"] || $result["current_link"])

		// включен пункт "Не отображать ссылку на элемент, если он имеет дочерние пункты"
		&& (!$result["hide_parent_link"] || empty($result["rows"][$row["id"]]))
	)
	{
		if ($row["othurl"])
		{
			echo '<a href="'.$row["othurl"].'"'.$row["attributes"].''
			.(! empty($row["active"]) || ! empty($row["active_child"]) ? ' class="active"' : '')
			.'>';
		}
		else
		{
			if ($row["attributes"] == 'last-link')
			{
				echo '<a class="more ' . $row["attributes"] . (! empty($row["active"]) || ! empty($row["active_child"]) ? '  active' : '' ) . ' " href="'.BASE_PATH_HREF.$row["link"].'">';
			}
			else {
				echo '<a class=" ' . $row["attributes"] . (! empty($row["active"]) || ! empty($row["active_child"]) ? '  active' : '' ) . ' " href="'.BASE_PATH_HREF.$row["link"].'">';				
			}
		}
	}

	//вывод изображения
	// if (! empty($row["img"]))
	// {
	// 	echo '<img src="'.$row["img"]["src"].'" width="'.$row["img"]["width"].'" height="'.$row["img"]["height"]
	// 	.'" alt="'.$row["img"]["alt"].'" title="'.$row["img"]["title"].'"> ';
	// }

	// название пункта меню
	if (! empty($row["name"]))
	{
		echo $row["name"];
		
		if ($row["attributes"] == 'last-link')
		{
			echo '<SVG width="9" height="16" viewBox="0 0 9 16" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M1.16145 0.994812C1.06195 0.994836 0.96471 1.02455 0.882183 1.08015C0.799657 1.13574 0.735595 1.2147 0.698194 1.30691C0.660792 1.39912 0.651751 1.50039 0.67223 1.59777C0.692708 1.69515 0.741773 1.7842 0.813147 1.85354L6.95963 8.00002L0.813147 14.1465C0.765161 14.1926 0.726851 14.2478 0.70046 14.3088C0.674068 14.3699 0.660126 14.4356 0.65945 14.5021C0.658773 14.5686 0.671377 14.6346 0.696522 14.6962C0.721666 14.7578 0.758846 14.8138 0.805885 14.8608C0.852924 14.9078 0.908876 14.945 0.970464 14.9702C1.03205 14.9953 1.09804 15.0079 1.16456 15.0072C1.23108 15.0066 1.29679 14.9926 1.35786 14.9662C1.41892 14.9398 1.47411 14.9015 1.52018 14.8535L8.02018 8.35353C8.11391 8.25976 8.16656 8.13261 8.16656 8.00002C8.16656 7.86743 8.11391 7.74028 8.02018 7.6465L1.52018 1.1465C1.47357 1.09851 1.41781 1.06035 1.35619 1.0343C1.29457 1.00824 1.22835 0.994815 1.16145 0.994812Z" fill="#333333" stroke="#333333" stroke-width="0.5">
			</path>
		  	</SVG>';
		}
	}


	if (
		// на текущей странице нет ссылки, если не включена настройка "Текущий пункт как ссылка"
		(!$row["active"] || $result["current_link"])

		// включен пункт "Не отображать ссылку на элемент, если он имеет дочерние пункты"
		&& (!$result["hide_parent_link"] || empty($result["rows"][$row["id"]]))
	)
	{
		echo '</a>';
	}

	// описание пункта меню
	if (! empty($row["text"]))
	{
		echo $row["text"];
	}

	if ($result["show_all_level"] || $row["active_child"] || $row["active"])
	{
		// вывод вложенного уровня меню
		$menu_data = $result;
		$menu_data["parent_id"] = $row["id"];
		$menu_data["level"]++;

		echo $this->get('show_level_topmenu_2', 'menu', $menu_data);
	}

	if ($row["active"])
	{
		// окончание пункта меню - текущей страницы
		echo '</li>';
	}
	elseif ($row["active_child"])
	{
		// окончание пункта меню для активного дочернего пункта
		echo '</li>';
	}
	else
	{
		// окончание любого другого пункта меню
		echo '</li>';
	}
}
// окончание уровня меню