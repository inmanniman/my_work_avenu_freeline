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

foreach ($result['rows'] as $row) {
    ?>

    <a href="/<?php echo $row['link'] ?>" class="catalog-leasing__box">
        <?php if ($row['action'] || $row['new'] || $row['hit']) { ?>
            <div class="catalog-leasing__label-wrapper">
                <?php if ($row['action']) { ?>
                    <div class="catalog-leasing__label catalog-leasing__label-sale">Скидка</div>
                <?php } ?>
                <?php if ($row['new']) { ?>
                    <div class="catalog-leasing__label catalog-leasing__label-new">Новинка</div>
                <?php } ?>
                <?php if ($row['hit']) { ?>
                    <div class="catalog-leasing__label catalog-leasing__label-hit">Часто покупают</div>
                <?php } ?>
            </div>
        <?php } ?>
        <div class="catalog-leasing__img-wrapper">


            <?php if (!empty($row['ids_param'][9])) { ?>
                <img width="360" height="247"
                     src="<?php echo $row['ids_param'][9]['value'][0]['vs']['medium']; ?>"
                     class="catalog-leasing__img" loading="lazy"
                     alt=""/>
            <?php } else { ?>
                <img width="360" height="247" src="<?php echo $row['img'][0]['vs']['medium']; ?>"
                     class="catalog-leasing__img" loading="lazy"
                     alt=""/>
                <?php
            } ?>

        </div>

        <div class="catalog-leasing__text container">
            <span class="catalog-leasing__name"> <?php echo $row['name'] ?></span>
            <ul class="catalog-leasing__parameter">
                <?php if (!empty($row['ids_param'][2])) { ?>
                    <li class="catalog-leasing__parameter-block">
                        <span class="catalog-leasing__parameter-data"><?php echo $row['ids_param'][2]['name'] ?></span>
                        <span class="catalog-leasing__parameter-data"><?php echo $row['ids_param'][2]['value'] ?></span>
                    </li>
                <?php } ?>
                <?php if (!empty($row['ids_param'][3])) { ?>
                    <li class="catalog-leasing__parameter-block">
                        <span class="catalog-leasing__parameter-data"><?php echo $row['ids_param'][3]['name'] ?></span>
                        <span class="catalog-leasing__parameter-data"><?php echo $row['ids_param'][3]['value'] ?></span>
                    </li>
                <?php } ?>
                <?php if (!empty($row['ids_param'][4])) { ?>
                    <li class="catalog-leasing__parameter-block">
                        <span class="catalog-leasing__parameter-data"><?php echo $row['ids_param'][4]['name'] ?></span>
                        <span class="catalog-leasing__parameter-data"><?php echo $row['ids_param'][4]['value'] ?></span>
                    </li>
                <?php } ?>
                <?php if (!empty($row['ids_param'][5])) { ?>
                    <li class="catalog-leasing__parameter-block">
                        <span class="catalog-leasing__parameter-data"><?php echo $row['ids_param'][5]['name'] ?></span>
                        <span class="catalog-leasing__parameter-data"><?php echo $row['ids_param'][5]['value'] ?></span>
                    </li>
                <?php } ?>
                <?php if (!empty($row['ids_param'][6])) { ?>
                    <li class="catalog-leasing__parameter-block">
                        <span class="catalog-leasing__parameter-data"><?php echo $row['ids_param'][6]['name'] ?></span>
                        <span class="catalog-leasing__parameter-data"><?php echo $row['ids_param'][6]['value'] ?></span>
                    </li>
                <?php } ?>

            </ul>
        </div>

        <div class="catalog-leasing__payment">
            <?php echo '<span class="catalog-leasing__sale">' . $this->diafan->_('Цена в лизинг/месяц:') . '</span>'; ?>
            <span class="catalog-leasing__sale"><?php echo $row['price'] ?>&nbsp;$</span>
        </div>
    </a>


<?php }
