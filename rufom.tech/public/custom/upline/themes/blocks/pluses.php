<?php
/**
 * Файл-блок шаблона
 *
 * @package    DIAFAN.CMS
 * @author     diafan.ru
 * @version    6.0
 * @license    http://www.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2018 OOO «Диафан» (http://www.diafan.ru/)
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
?>
<section class="transfer-of-services container">
    <div class="transfer-of-services__block">
        <svg class="transfer-of-services__svg">
            <use href="/assets/sprite.svg#box"></use>
        </svg>
        <div class="transfer-of-services__desc">Быстрая доставка товара в любой регион</div>
    </div>

    <div class="transfer-of-services__block">
        <svg class="transfer-of-services__svg">
            <use href="/assets/sprite.svg#discount"></use>
        </svg>
        <div class="transfer-of-services__desc">Быстрая доставка товара в любой регион</div>
    </div>

    <div class="transfer-of-services__block">
        <svg class="transfer-of-services__svg">
            <use href="/assets/sprite.svg#certificate2"></use>
        </svg>
        <div class="transfer-of-services__desc">Быстрая доставка товара в любой регион</div>
    </div>

    <div class="transfer-of-services__block">
        <svg class="transfer-of-services__svg">
            <use href="/assets/sprite.svg#support"></use>
        </svg>
        <div class="transfer-of-services__desc">Быстрая доставка товара в любой регион</div>
    </div>

</section>
