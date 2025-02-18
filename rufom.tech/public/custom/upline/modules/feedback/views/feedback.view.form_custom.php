<?php
/**
 * Шаблон формы добавления сообщения в обратной связи
 *
 * @package    DIAFAN.CMS
 * @author     diafan.ru
 * @version    6.0
 * @license    http://www.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2018 OOO «Диафан» (http://www.diafan.ru/)
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

if(! empty($result["text"]))
{
	echo $result["text"];
	return;
}
//action=""
echo '
<div class="feedback_form">
<form method="POST" enctype="multipart/form-data" class="ajax">
<input type="hidden" name="module" value="feedback">
<input type="hidden" name="action" value="add">
<input type="hidden" name="form_tag" value="'.$result["form_tag"].'">
<input type="hidden" name="site_id" value="'.$result["site_id"].'">
<input type="hidden" name="tmpcode" value="'.md5(mt_rand(0, 9999)).'">';


//заголовок блока
if (! empty($result["name"]))
{
	echo '<div class="title">'.$result["name"].'</div>';
}

$required = false;
if(! empty($result["rows"]))
{
	foreach ($result["rows"] as $row) //вывод полей из конструктора форм
	{
		if($row["required"])
		{
			$required = true;
		}
		echo '<div class="feedback_form_param'.$row["id"].' field_wrap">';

		switch ($row["type"])
		{
			case 'title':
				echo '<div class="infoform">'.$row["name"].':</div>';
				break;

            case 'text':
                echo '<div><input type="text" name="p' . $row["id"] . '" value="" class="form-control" placeholder="' . $row["name"] . '"></div>';
                break;

            case "email":
                echo '<div><input type="email" name="p' . $row["id"] . '" value="" class="form-control" placeholder="' . $row["name"] . '"></div>';
                break;

            case "phone":
                echo '<div><input type="tel" name="p' . $row["id"] . '" value="" class="form-control" placeholder="' . $row["name"] . '"></div>';
                break;

            case 'textarea':
                echo '<div><textarea name="p' . $row["id"] . '" rows="5" class="form-control"  placeholder="' . $row["name"] . '"></textarea></div>';
                break;

			case 'date':
			case 'datetime':
				$timecalendar  = true;
				echo '<div class="infofield">'.$row["name"].($row["required"] ? '<span style="color:red;">*</span>' : '').':</div>
					<input type="text" name="p'.$row["id"].'" value="" class="timecalendar" showTime="'
					.($row["type"] == 'datetime'? 'true' : 'false').'">';
				break;

			case 'numtext':
				echo '<div class="infofield">'.$row["name"].($row["required"] ? '<span style="color:red;">*</span>' : '').':</div>
				<input type="number" name="p'.$row["id"].'" value="">';
				break;

			case 'checkbox':
				echo '<input name="p'.$row["id"].'" id="feedback_p'.$row["id"].'" value="1" type="checkbox" ><label for="feedback_p'.$row["id"].'">'.$row["name"].($row["required"] ? '<span style="color:red;">*</span>' : '').'</label>';
				break;

			case 'radio':
				echo '<div class="infofield">'.$row["name"].($row["required"] ? '<span style="color:red;">*</span>' : '').':</div>';
				foreach ($row["select_array"] as $select)
				{
					echo '<input name="p'.$row["id"].'" type="radio" value="'.$select["id"].'" id="feedback_form_p'.$row["id"].'_'.$select["id"].'"> <label for="feedback_form_p'.$row["id"].'_'.$select["id"].'">'.$select["name"].'</label>';
				}
				break;

			case 'select':
				echo '<div class="infofield">'.$row["name"].($row["required"] ? '<span style="color:red;">*</span>' : '').':</div>
				<select name="p'.$row["id"].'" class="inpselect">
					<option value="">-</option>';
				foreach ($row["select_array"] as $select)
				{
					echo '<option value="'.$select["id"].'">'.$select["name"].'</option>';
				}
				echo '</select>';
				break;

			case 'multiple':
				echo '<div class="infofield">'.$row["name"].($row["required"] ? '<span style="color:red;">*</span>' : '').':</div>';
				foreach ($row["select_array"] as $select)
				{
					echo '<input name="p'.$row["id"].'[]" id="feedback_p'.$select["id"].'[]" value="'.$select["id"].'" type="checkbox"><label for="feedback_p'.$select["id"].'[]">'.$select["name"].'</label><br>';
				}
				break;

//                max="'.$row["max_count_attachments"].'"
			case "attachments":
				echo '<div class="infofield">'.$row["name"].($row["required"] ? '<span style="color:red;">*</span>' : '').':</div>';
				echo '<div class="inpattachment"><input type="file" name="attachments'.$row["id"].'[]" class="inpfiles" multiple></div>';
				echo '<div class="inpattachment" style="display:none"><input type="file" name="hide_attachments'.$row["id"].'[]" class="inpfiles" multiple></div>';
				if ($row["attachment_extensions"])
				{
					echo '<div class="attachment_extensions">('.$this->diafan->_('Доступные типы файлов').': '.$row["attachment_extensions"].')</div>';
				}
				break;

			case "images":
				echo '<div class="infofield">'.$row["name"].($row["required"] ? '<span style="color:red;">*</span>' : '').':</div><div class="images"></div>';
				echo '<input type="file" name="images'.$row["id"].'" param_id="'.$row["id"].'" class="inpimages">';
				break;
		}

		if($row["text"])
		{
			echo '<div class="feedback_form_param_text">'.$row["text"].'</div>';
		}


		if($row["type"] != 'title')
		{
			echo '<div class="errors error_p'.$row["id"].'"'.($result["error_p".$row["id"]] ? '>'.$result["error_p".$row["id"]] : ' style="display:none">').'</div>';
		}
        echo '</div>';
	}
}

//Защитный код
echo $result["captcha"];
echo '<div class="privacy_field">'.$this->diafan->_('Отправляя форму, я даю согласие на <a href="%s">обработку персональных данных</a>.', true, BASE_PATH_HREF.'privacy'.ROUTE_END).'</div>';

//Кнопка Отправить
echo '<div class="btn-wrap"><button class="btn" type="submit">'.$this->diafan->_('Отправить', false).'</button></div>';


//if($required)
//{
//	echo '<div class="required_field"><span style="color:red;">*</span> — '.$this->diafan->_('Поля, обязательные для заполнения').'</div>';
//}

echo '</form>';
echo '<div class="errors error"'.($result["error"] ? '>'.$result["error"] : ' style="display:none">').'</div>
</div>';
