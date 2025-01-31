<?php
/**
 * Шаблон формы добавления сообщения в обратной связи
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

// if(! empty($result["text"]))
// {
// 	echo '<section class="_text">'.$result["text"].'</section>';
// 	return;
// }



echo
'<form action="" id="form-2" class="form contact ajax" method="POST" enctype="multipart/form-data">
	<input type="hidden" name="module" value="feedback">
	<input type="hidden" name="action" value="add">
	<input type="hidden" name="form_tag" value="'.$result["form_tag"].'">
	<input type="hidden" name="site_id" value="'.$result["site_id"].'">
	<input type="hidden" name="tmpcode" value="'.md5(mt_rand(0, 9999)).'">';
//заголовок блока
if (! empty($result["name"]))
{
	echo '<div class="form-title">'.$result["name"].'</div>';
}
	$required = false;
	if(! empty($result["rows"]))
	{
		echo '<div class="form__fields">';

		foreach ($result["rows"] as $row) //вывод полей из конструктора форм
		{
			if($row["required"])
			{
				$required = true;
			}
			// echo '<div class="field-d feedback_form_param'.$row["id"].'">';

			// print_r($row["id"]);

			switch ($row["type"])
			{
				// case 'title':
				// 	echo '<div class="field-d__title">'.$row["name"].':</div>';
				// 	break;

				case 'text':
					echo '<div class="form__field"><label>Имя</label>
					<input class="name" type="text" name="p'.$row["id"].'" placeholder="' .$row["name"] .'"></div>';
					break;

				case "phone":
					echo '<div class="form__field"><label>Телефон</label>
					<input class="required-field phone" type="text" name="p'.$row["id"].'" placeholder="' .$row["name"] . '" required > </div>';
					break;

				case "email":
					echo '<div class="form__field"><label>Email</label>
					<input class="required-field email" type="text" name="p'.$row["id"].'" placeholder="' .$row["name"] . '"  required ></div>';
					break;

				// case 'textarea':
				// 	echo '<div class="field-d__name">'.($row["required"] ? '<span class="_asterisk"></span>' : '').'</div>
				// 	<textarea class="form-control" name="p'.$row["id"].'" placeholder=" ' .$row["name"] .'" rows="8"></textarea>';
				// 	break;
			}
			if($row["type"] != 'title')
			{
				echo '<div class="errors error_p'.$row["id"].'"'.($result["error_p".$row["id"]] ? '>'.$result["error_p".$row["id"]] : ' style="display:none">').'</div>';
			}

			// echo '</div>';
		}
		echo '</div>';
	}

	//Защитный код
	// echo $result["captcha"];

	//Кнопка Отправить
	echo
	'<div class="form__action">
		<input type="submit" value="'.$this->diafan->_('Отправить') .'" class="btn btn-submit btn_style-1">
	</div>';

	echo '<div class="privacy-policy">'.$this->diafan->_('Нажимая на кнопку, вы даете согласие на обработку персональных данных и соглашаетесь c <a href="#modal-pp" class="call-privacy-policy">политикой конфиденциальности</a>', true, BASE_PATH_HREF.'privacy'.ROUTE_END).'</div>';

	// if($required)
	// {
	// 	echo '<div class="required_field"><span class="_asterisk"></span> '.$this->diafan->_('').'</div>';
	// }

echo '</form>';

echo '<div class="errors error"'.($result["error"] ? '>'.$result["error"] : ' style="display:none">').'</div>';
