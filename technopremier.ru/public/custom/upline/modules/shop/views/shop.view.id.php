<?php
/**
 * Шаблон страницы товара
 *
 * @package    DIAFAN.CMS
 * @author     diafan.ru
 * @version    7.0
 * @license    http://www.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2020 OOO «Диафан» (http://www.diafan.ru/)
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
    <div class="container">
        <section class="card">
            <?php if (!empty($result['img'])) { ?>
                <div class="card__swiper">
                    <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff"
                         class="swiper main-card-swiper">
                        <div class="swiper-wrapper">
                            <?php foreach ($result['img'] as $img) {?>
                                <div class="swiper-slide">
                                    <a href="<?php echo $img['vs']['large'] ?>" data-fancybox="product" class="swiper main-card-swiper__link">
                                        <img src="<?php echo $img['vs']['medium'] ?>" alt="<?php echo $img['alt'] ?>"
                                             title="<?php echo $img['title'] ?>"/>
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div thumbsSlider="" class="swiper thumb-card-swiper">
                        <div class="swiper-wrapper">
                            <?php foreach ($result['img'] as $img) { ?>
                                <div class="swiper-slide">
                                    <img src="<?php echo $img['vs']['preview'] ?>" alt="<?php echo $img['alt'] ?>" width="150" height="96"/>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                </div>
            <?php } ?>
            <div class="card__content">
                <h1 class="card__title"><?php echo $result['name'] ?></h1>
                <?php if (!empty($result['anons'])) { ?>
                    <span class="card__subtitle"><?php echo $result['anons'] ?></span>
                <?php } ?>
                <div class="card__wrapper-description-cars">
                    <?php if (!empty($result['ids_param'][2])) { ?>
                        <div class="card__description-cars">
                            <span><?php echo $result['ids_param'][2]['name'] ?></span>
                            <span><?php echo $result['ids_param'][2]['value'] ?></span>
                        </div>
                    <?php } ?>
                    <?php if (!empty($result['ids_param'][3])) { ?>
                        <div class="card__description-cars">
                            <span><?php echo $result['ids_param'][3]['name'] ?></span>
                            <span><?php echo $result['ids_param'][3]['value'] ?></span>
                        </div>
                    <?php } ?>
                    <?php if (!empty($result['ids_param'][4])) { ?>
                        <div class="card__description-cars">
                            <span><?php echo $result['ids_param'][4]['name'] ?></span>
                            <span><?php echo $result['ids_param'][4]['value'] ?></span>
                        </div>
                    <?php } ?>
                    <?php if (!empty($result['ids_param'][5])) { ?>
                        <div class="card__description-cars">
                            <span><?php echo $result['ids_param'][5]['name'] ?></span>
                            <span><?php echo $result['ids_param'][5]['value'] ?></span>
                        </div>
                    <?php } ?>
                    <?php if (!empty($result['ids_param'][6])) { ?>
                        <div class="card__description-cars">
                            <span><?php echo $result['ids_param'][6]['name'] ?></span>
                            <span><?php echo $result['ids_param'][6]['value'] ?></span>
                        </div>
                    <?php } ?>
                </div>

                <?php if (!empty($result['ids_param'][8]['value'][0]['link'])) { ?>
                    <a class="card__btn" href="<?php echo $result['ids_param'][8]['value'][0]['link'] ?>">
                        <svg class="card__btn-img">
                            <use href="/assets/sprite.svg#download"></use>
                        </svg>
                        <span><?php echo $this->diafan->_('Спецификация'); echo $result['article']; ?></span>
                    </a>
                <?php } ?>
                <button class="btn card__btn-red" data-fancybox data-src="#dialog-kp">Запросить ком. предложение</button>
            </div>
        </section>
    </div>
<?php if (!empty($result['text'])) { ?>
    <section class="description container">
        <a class="description__btn">
            <?php 
            echo '<span class="description__description-text">' . $this->diafan->_('Описание') . '</span>';
            ?>
            <div class="description__wrapper-icon">
                <svg class="description__icon-plus">
                    <use href="/assets/sprite.svg#plus-description"></use>
                </svg>
            </div>
        </a>
        <div class="description__content">
            <?php echo $result['text'] ?>
        </div>
    </section>
<?php } ?>


<?php if (!empty($result['ids_param'][7])) { ?>
    <section class="characteristic container">
        <a class="characteristic__btn">
            <?php 
            echo '<span class="characteristic__description-text">' . $this->diafan->_('Технические характеристики') . '</span>';
            ?>
            <div class="characteristic__wrapper-icon">
                <svg class="characteristic__icon-plus">
                    <use href="/assets/sprite.svg#plus-description"></use>
                </svg>
            </div>
        </a>

        <div class="characteristic__content">
            <?php echo $result['ids_param'][7]['value'] ?>
        </div>
    </section>
<?php } ?>


<?php echo $this->htmleditor('<insert name="show_block_rel" module="shop" images="1" template="leasing">');
