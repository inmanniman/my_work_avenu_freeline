<?php
/**
 * Шаблон формы подписки на рассылки
 * 
 * Шаблонный тег <insert name="show_form" module="subscription" [template="шаблон"]>:
 * блок вывода формы подписки на рассылки
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
//action=""
echo '
<form method="POST" enctype="multipart/form-data" class="subscription ajax">
<input type="hidden" name="module" value="subscription">
<input type="hidden" name="action" value="add">
<input type="hidden" name="form_tag" value="'.$result["form_tag"].'">
<div class="form-wrap">
<input type="email" name="mail" class="form-input form-input--dark" placeholder="Введите ваш E-mail" required>
<button type="submit" class="icon-btn"><i class="ic ic--plane"></i></button>
</div>
<div class="errors error_mail"'.($result["error_mail"] ? '>'.$result["error_mail"] : ' style="display:none">').'</div>
<div class="errors error"'.($result["error"] ? '>'.$result["error"] : ' style="display:none">').'</div>';
echo $result["captcha"];
echo '
</form>';