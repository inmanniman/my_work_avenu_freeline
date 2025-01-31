<?php
/**
 * Шаблон элементов в списке товаров
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

if(empty($result['rows'])) return false;

?>
<div class="category-grid">
    <?php foreach ($result['rows'] as $row){ ?>
        <div class="item-wrap">
            <div class="item">
                <?php if($row['img']){ ?><a href="<?= BASE_PATH_HREF . $row['link'] ?>" class="item-img"><img loading="lazy" width="400" height="300" src="<?= BASE_PATH . $row['img'][0]['src'] ?>" alt="<?= $row['img'][0]['alt'] ?>" title="<?= $row['img'][0]['alt'] ?>" /></a><?php } ?>
                <a href="<?= BASE_PATH_HREF . $row['link'] ?>" class="item-title"><?= $row['name'] ?></a>
                <?php if(isset($row['ids_param'][3]['value'])){ ?>
                    <div class="item-char-wrap">
                        <div class="table-wrap">
                            <?php if(isset($row['ids_param'][63]['value'])){ ?>
                                <div class="category-icons">
                                    <?php foreach ($row['ids_param'][63]['value'] as $it){ ?>
                                        <span class="tooltip ic <?php echo  substr(strrchr($it, "||"), 1); ?>">
                                    <span class="tooltiptext">
                                        <?php echo strstr($it, "||" , true); ?>
                                    </span>
                                </span>
                                    <?php } ?>
                                </div>
                            <?php }else{ ?>
                                <table class="item-char">
                                    <tbody>
                                    <?php if(isset($row['ids_param'][3]['value'])){ ?>
                                        <tr>
                                            <td>Толщина:</td>
                                            <td><?php
                                                $values = $row['ids_param'][3]['value'];
                                                if(count($values) > 1){
                                                    echo min($values) . 'мм - ' . max($values);
                                                }else{
                                                    echo $values[0];
                                                }
                                                echo 'мм ';
                                                ?></td>
                                        </tr>
                                    <?php } ?>
                                    <?php if(isset($row['ids_param'][29]['value'])){ ?>
                                        <tr>
                                            <td>Ширина рулона:</td>
                                            <td><?php
                                                $values = $row['ids_param'][29]['value'];
                                                if(count($values) > 1){
                                                    $data = [];
                                                    foreach ($values as $value) {
                                                        $data[] = explode(' ', $value)[0];
                                                    }
                                                    echo min($data) . '-' . max($data);
                                                    echo '&thinsp;' . explode(' ', $value)[1];
                                                }else{
                                                    echo $values[0];
                                                }
                                                ?></td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
                <div class="item-grid">
                    <div class="item-price-wrap">
                        <?php if($row['price']){ ?>
                            <div class="item-price">от <?= $row['price'] ?> руб</div>
                        <?php }else{ ?>
                            <div class="item-price">цена по запросу</div>
                        <?php } ?>
                    </div>
                    <div class="item-btn">
                        <a href="<?= BASE_PATH_HREF . $row['link'] ?>" class="btn">Сделать расчет</a>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
