<?php
/**
 * Шаблон страницы товара
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

?>
<?php
$url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$url = explode('?', $url);
$url = $url[0];

?>
<script type="application/ld+json">
    {
        "@context": "https://schema.org/",
        "@type": "Product",
        "name": "<?php echo $this->htmleditor('<insert name="show_h1">'); ?>",
        <?php if(!empty($result["img"][0])){ ?>
        "image": "<?= BASE_PATH . $result["img"][0]["vs"]["large"] ?>",
        <?php } ?>
        "description": "<?= strip_tags($result['text']) ?>",
        "brand": {
            "@type": "Brand",
            "name": "ООО ПК РУФОМ"
        },
        "offers": {
            "@type": "Offer",
            "url": "<?= $url ?>",
            "priceCurrency": "RUB",
            "price": "<?= $result['price_arr'][0]['price'] ?>",
            "availability": "https://schema.org/InStock",
            "itemCondition": "https://schema.org/NewCondition"
        }
    }
</script>
<div class="product content">
        <div class="product-wrap">
            <div class="product-swiper-block">
                <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff; --swiper-navigation-size: 20px;" class="swiper product-swiper-slider">
                    <div class="swiper-wrapper">
                        <?php foreach ($result["img"] as $i => $img) { ?>
                            <div class="swiper-slide">
                                <a href="<?= BASE_PATH . $img["vs"]["large"] ?>" data-fancybox="products" class="item"><img src="<?= BASE_PATH . $img["vs"]["large"] ?>" loading="lazy" alt=""></a>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
                <div class="swiper product-thumbs">
                    <div class="swiper-wrapper">
                        <?php foreach ($result["img"] as $i => $img) { ?>
                        <div class="swiper-slide">
                            <img class="item" src="<?= BASE_PATH . $img["vs"]["medium"] ?>" loading="lazy" />
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <div class="product-info js_shop_id js_shop ">
            	<?= $this->get('buy_form_custom', 'shop', array("row" => $result, "result" => $result)) ?>
                <div class="product-btn"><span class="js_shop_one_click shop_one_click"><a class="btn" onclick="addFormData();" data-fancybox href="#request2_modal">Заявка на расчет стоимости</a></span></div>
                <script>
                    function addFormData(){
                        var idParam;
                        var toForm = '';
                        document.getElementById("id19").value = "<?php echo $result['name']; ?>";
                        <?php foreach ($result['depends_param'] as $item ){ ?>
                        if(document.getElementById('param<?php echo $item["id"]; ?>')){
                            idParam = document.getElementById('param<?php echo $item["id"]; ?>');
                            toForm += '<?php echo $item["name"]; ?>: ' + idParam.options[idParam.selectedIndex].text + '\n';
                            console.log( document.getElementById('param<?php echo $item["id"]; ?>').value );
                        }
                        <?php } ?>
                        var options = document.querySelectorAll('.js_shop_param_price'),
                            paramPrice;
                        [].forEach.call(options, function (option) {
                            if (option.style.display == 'block')
                            {
                                paramPrice = option.innerText;
                                document.getElementById("id21").value = paramPrice;
                            }
                        });
                        document.getElementById("id20").value = toForm;
                    }
                </script>
				<?php if(!empty($result['ids_param'][39])){
                    $values = $result['ids_param'][39]['value'];
                    $mid = ceil(count($values) / 2);
                    $first = array_slice($values, 0, $mid);
                    $second = array_slice($values, $mid);
                    ?>
                    <div class="product-char">
                        <div class="s-title">Характеристики:</div>
                        <div class="product-char-wrap">
                            <?php if($first){ ?>
                            <ul class="characteristics">
                                <?php foreach ($first as $value) {
                                    $value_data = explode('||', $value);
                                    ?>
                                <li><span class="characteristics-icon"><?php if(isset($value_data[1])){ ?><i class="ic <?= $value_data[1] ?>"></i><?php } ?></span> <?= $value_data[0] ?></li>
                                <?php } ?>
                            </ul>
                            <?php } ?>
                            <?php if($second){ ?>
                            <ul class="characteristics">
                                <?php foreach ($second as $value) {
                                    $value_data = explode('||', $value);
                                    ?>
                                <li><span class="characteristics-icon"><?php if(isset($value_data[1])){ ?><i class="ic <?= $value_data[1] ?>"></i><?php } ?></span> <?= $value_data[0] ?></li>
                                <?php } ?>
                            </ul>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
		<?php if($result['anons']){ ?>
        <div class="product-desc">
            <div class="s-title">Описание:</div>
            <div class="styled-description"><?= $result['anons'] ?></div>
        </div>
		<?php } ?>
        <?php if(!empty($result['ids_param'][40])){
                    $values = $result['ids_param'][40]['value'];
                    $c = count($values);
                    $over = ceil($c / 3);
        ?>
        <div class="product-activity">
            <div class="s-title">Области применения:</div>
            <div class="product-activity-wrap">
                <ul class="activity">
                    <?php foreach ($values as $i => $value) {
                        $value_data = explode('||', $value);
                        ?>
                        <?php if($i && $i % $over === 0){ ?>
                        </ul><ul class="activity">
                        <?php } ?>
                        <li><span class="circle"><?php if(isset($value_data[1])){ ?><i class="ic <?= $value_data[1] ?>"></i><?php } ?></span> <?= $value_data[0] ?></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <?php } ?>
	<?php if($result["param"]){ ?>
		<div class="product-tech-char">
				<div class="s-title">Технические характеристики:</div>
				<?= $this->get('param_custom', 'shop', array("rows" => $result["param"], "id" => $result["id"])) ?>
		</div>
	<?php } ?>
    <?php if(!empty($result['ids_param'][41]['value'][0]['src'])||$result['text']){ ?>
    <div class="product-full-desc">
        <div class="container">
            <div class="product-full-desc-wrap">
                <?php if(!empty($result['ids_param'][41]['value'][0]['src'])){ ?>
                    <div class="product-full-desc-image-wrap">
                        <img width="" height="" class="product-full-desc-image" src="<?= BASE_PATH . $result['ids_param'][41]['value'][0]['src'] ?>" alt="<?= $result['ids_param'][41]['value'][0]['alt'] ?>" title="<?= $result['ids_param'][41]['value'][0]['alt'] ?>" loading="lazy">
                    </div>
                <?php } ?>
				<?php if($result['text']){ ?>
                <div class="product-full-desc-info">
                    <div class="s-title">Подробное описание:</div>
                    <div class="styled-description"><?= $this->htmleditor($result['text']) ?></div>
                </div>
				<?php } ?>
            </div>
        </div>
    </div>
    <?php } ?>
    <div class="product-sliders">
        <div class="product-sliders-wrap">
            <div class="product-sliders-block">
                <?= $this->htmleditor('<insert name="show_include" file="sertificate"></insert>') ?>
            </div>

            <div class="product-sliders-block">
                <?= $this->htmleditor('<insert name="show_block_rel" template="custom" module="shop" count="10" images="1">') ?>
                <div class="production"><a href="/produktsiya/proizvodstvo-izdeliy/"><img width="520" height="174" src="/<?= $this->htmleditor('<insert name="custom" path="img/productions.jpg">') ?>?v=1" alt="Productions" title="Productions" class="img" loading="lazy"></a></div>
            </div>
        </div>
    </div>
</div>
