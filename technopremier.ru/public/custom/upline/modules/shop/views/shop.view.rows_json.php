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

?>
<script> window.productData = [

        <?php foreach ($result['rows'] as $row)
        {

        if (!empty($row['ids_param'][9]['value'][0]['vs']['calc'])) {
            $photo = $row['ids_param'][9]['value'][0]['vs']['calc'];
        } else {
            $photo = '/custom/upline/images/placeholder.svg';
        }
        $id = $row['id'];
        $name = $row['name'];
        $price = $row['price_arr'][0]['price'];
        $price_no_format = $row['price_arr'][0]['price_no_format'];
        if (!empty($row['brand']['name'])) {
            $brand = $row['brand']['name'];
        } else {
            $brand = '';
        }
        $sku = $row['article'];
        ?>
        {
            "id": "<?php echo $id; ?>",
            "name": "<?php echo $name; ?>",
            "photo": "<?php echo $photo; ?>",
            "price": "<?php echo $price; ?>",
            "price_no_format": "<?php echo $price_no_format; ?>",
            "sku": "<?php echo $sku; ?>",
            "brand": "<?php echo $brand; ?>"
        },



        <?php } ?>

    ];
</script>
<div class="leasing-calc-tr__list">
    <ul class="list">
        <?php foreach ($result['rows'] as $key=>$row) {
            if (!empty($row['ids_param'][9]['value'][0]['vs']['calc'])) {
                $photo = $row['ids_param'][9]['value'][0]['vs']['calc'];
            } else {
                $photo = '/custom/upline/images/placeholder.svg';
            }
            $id = $row['id'];
            $name = $row['name'];
            $price = $row['price_arr'][0]['price'];
            $price_no_format = $row['price_arr'][0]['price_no_format'];
            ?>
            <li class="leasing-calc-tr__item" data-id="<?php echo $key ?>"  data-price="<?php echo $price_no_format ?>">
                <div class="picture">
                    <img class="img" src="<?php echo $photo ?>" alt="<?php echo $row['name'] ?>">
                </div>
                <div class="name" ><?php echo $name ?></div>
                <div class="price"><?php echo $price ?> $</div>
            </li>
        <?php } ?>
    </ul>
</div>
