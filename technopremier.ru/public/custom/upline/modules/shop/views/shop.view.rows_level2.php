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
    <a href="<?php echo BASE_PATH_HREF . $row["link"]; ?>" class="rent-excavators__box">
        <?php
        if (!empty($row['ids_param'][9])) { ?>
            <div class="rent-excavators__img-wrapper">
                <img width="360" height="247"
                     src="<?php echo $row['ids_param'][9]['value'][0]['vs']['medium']; ?>"
                     class="rent-excavators__img" loading="lazy"
                     alt="crawler-excavator"/>
            </div>
        <?php } else {
            if (!empty($row["img"])) {
                foreach ($row["img"] as $img) {
                    ?>
                    <div class="rent-excavators__img-wrapper">
                        <img width="360" height="247" src="<?php echo $img['vs']['medium']; ?>"
                             class="rent-excavators__img" loading="lazy"
                             alt="crawler-excavator"/>
                    </div>
                    <?php
                }
            }
        }
        ?>
        <div class="rent-excavators__text container">
            <span class="rent-excavators__number"><?php echo $row["name"]; ?></span>
            <ul class="rent-excavators__parameter">
                <?php if (!empty($row['ids_param'][2])) { ?>
                    <li class="rent-excavators__parameter-block">
                        <span class="rent-excavators__parameter-data"><?php echo $row['ids_param'][2]['name'] ?></span>
                        <span class="rent-excavators__parameter-data"><?php echo $row['ids_param'][2]['value'] ?></span>
                    </li>
                <?php } ?>
                <?php if (!empty($row['ids_param'][3])) { ?>
                    <li class="rent-excavators__parameter-block">
                        <span class="rent-excavators__parameter-data"><?php echo $row['ids_param'][3]['name'] ?></span>
                        <span class="rent-excavators__parameter-data"><?php echo $row['ids_param'][3]['value'] ?></span>
                    </li>
                <?php } ?>
                <?php if (!empty($row['ids_param'][4])) { ?>
                    <li class="rent-excavators__parameter-block">
                        <span class="rent-excavators__parameter-data"><?php echo $row['ids_param'][4]['name'] ?></span>
                        <span class="rent-excavators__parameter-data"><?php echo $row['ids_param'][4]['value'] ?></span>
                    </li>
                <?php } ?>
                <?php if (!empty($row['ids_param'][5])) { ?>
                    <li class="rent-excavators__parameter-block">
                        <span class="rent-excavators__parameter-data"><?php echo $row['ids_param'][5]['name'] ?></span>
                        <span class="rent-excavators__parameter-data"><?php echo $row['ids_param'][5]['value'] ?></span>
                    </li>
                <?php } ?>
                <?php if (!empty($row['ids_param'][6])) { ?>
                    <li class="rent-excavators__parameter-block">
                        <span class="rent-excavators__parameter-data"><?php echo $row['ids_param'][6]['name'] ?></span>
                        <span class="rent-excavators__parameter-data"><?php echo $row['ids_param'][6]['value'] ?></span>
                    </li>
                <?php } ?>

            </ul>
        </div>
    </a>
    <?php

}

//Кнопка "Показать ещё"
if (!empty($result["show_more"])) {
    echo $result["show_more"];
}
