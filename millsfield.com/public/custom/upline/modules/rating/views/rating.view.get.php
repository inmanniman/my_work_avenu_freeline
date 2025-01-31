<?php
/**
 * Шаблон рейтинга элемента
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
echo '<section class="rating-section">';
echo '<span class="rating-section__title">'. $this->diafan->_('rating-title') .'</span>';
echo '<div class="js-rating-article rating-section__counter" data-module_name="'.$result["module_name"].'" data-element_type="'.$result["element_type"].'" data-element_id="'.$result["element_id"].'" data-rating="' . $result["rating"] . '""></div>';
echo '<div class="rating-errors errors error"'.(!empty($result["error"]) ? '>'.$result["error"] : ' style="display:none">').'</div>';
echo '</section>';