<?php
/**
 * Шаблон блока фотографий
 *
 * Шаблонный тег <insert name="show_block" module="swiper" [count="количество"]
 * [cat_id="категория"] [site_id="страница_с_прикрепленным_модулем"]
 * [sort="порядок_вывода"]
 * [images_variation="тег_размера_изображений"]
 * [only_module="only_on_module_page"] [template="шаблон"]>:
 * блок фотографий
 *
 * @package    DIAFAN.CMS
 * @author     diafan.ru
 * @version    7.0
 * @license    http://www.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2021 OOO «Диафан» (http://www.diafan.ru/)
 */


$filename = 'createSwiper.js';

$file = fopen($filename, 'w');

if ($file === false) {
    $error = error_get_last();
    echo "Не удалось создать файл. Ошибка: " . $error['message'];
} else {
    print "
    // Import Swiper and modules
    import Swiper from 'swiper';
    import { EffectFade } from 'swiper/modules';
    // Now you can use Swiper
    const swiper = new Swiper('.mySwiper', {";

    print "modules: ['effect-fade'],
    ";

    

    print '
    ';
    
    print '
    ';
    // spaceBetween 
    if (!empty($result["spaceBetween1"])) {
      print 'spaceBetween: '.$result['spaceBetween1'].',';
    }
    
    
    print '
    });';
    // Записываем содержимое createSwiper.php в файл createSwiper.js
    fwrite($file, ob_get_contents());
    fclose($file);
} 

?>