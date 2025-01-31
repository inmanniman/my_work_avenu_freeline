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

if (!defined('DIAFAN')) {
    $path = __FILE__;
    while (!file_exists($path . '/includes/404.php')) {
        $parent = dirname($path);
        if ($parent == $path) exit;
        $path = $parent;
    }
    include $path . '/includes/404.php';
}


if (empty($result)) {
    return false;
}

if (!isset($GLOBALS['include_bs_js'])) {
    $GLOBALS['include_bs_js'] = true;
    //скрытая форма для отправки статистики по кликам
    echo
    '<form method="POST" enctype="multipart/form-data" style="display: none" action="" class="ajax js_bs_form bs_form _hidden">
		<input type="hidden" name="module" value="bs">
		<input type="hidden" name="action" value="click">
		<input type="hidden" name="banner_id" value="0">
	</form>';
}
?>
<section class="catalog container">
    <?php foreach ($result as $row) { ?>
        <div class="catalog__wrapper-content">
            <div class="catalog__wrapper-boxs">
                <div class="catalog__box-text">
                    <span class="catalog__title"><?php echo $row['name']; ?></span>
                    <span class="catalog__subtitle"><?php echo $row['alt']; ?></span>
                </div>
                <?php echo $row['text']; ?>
            </div>
            <div class="catalog__wrapper-under-text">
                <a href="/shop" class="js_bs_counter bs_counter catalog__under-link">
                    <?php echo '
                        <span class="catalog__under-title">' . $this->diafan->_('Весь каталог') . ' <svg class="catalog__under-btn" width="20" height="17" viewBox="0 0 20 17" xmlns="http://www.w3.org/2000/svg"><use href="/assets/sprite.svg#arrow-left"></use></svg></span>
                        <span class="catalog__under-text">' . $this->diafan->_('более 350 позиций') . '</span>'; 
                    ?>
                </a>
            </div>
        </div>
    <?php } ?>
</section>
