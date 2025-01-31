<?php
/**
 * Шаблон элементов в списке товаров
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


if (empty($result['rows'])) return false;
foreach ($result['rows'] as $row) { ?>
    <a href="/<?php echo $row['link'] ?>" class="small-blocks__box">
        <?php if($row['ids_param'][11]['value']){ ?>
            <span class="small-blocks__text"><?php echo $row['ids_param'][11]['value']  ?> <b><?php echo $row['ids_param'][12]['value'] ?></b></span>
        <?php }else{ ?>
            <span class="small-blocks__text"><?php echo $row['name'] ?></span>
        <?php } ?>
        <div class="small-blocks__img-wrapper">
           <img width="195" height="195" src="<?php echo $row['ids_param'][10]['value'][0]['vs']['large'] ?>"
                     class="small-blocks__img" loading="lazy" alt="crawler-excavator"/>
        </div>
    </a>
<?php }



