/**
 * JS-сценарий блока корзины
 *
 * @package    DIAFAN.CMS
 * @author     diafan.ru
 * @version    7.0
 * @license    http://www.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2021 OOO «Диафан» (http://www.diafan.ru/)
 */
$(".js_cart_count input").keyup(function(e){e.target.value=e.target.value.replace(/,/g,'.')});var js_cart_block_scroll=0;diafan_ajax.before.cart_recalc=function(form){var $scroll=$(form).closest('._scroll');js_cart_block_scroll=$scroll.length&&$scroll.scrollTop()?$scroll.scrollTop():0};diafan_ajax.success.cart_recalc=function(form,response){if(response.data&&response.data.hasOwnProperty('#show_cart')){$('.js_show_cart').html(prepare(response.data['#show_cart'])).show()}
if(!form.is('.js_cart_block_form, .cart_block_form')){return!0}
if(response.data){$.each(response.data,function(k,val){if(k=="form"){k=form}
if(val){$(k).html(prepare(val)).show()}else{$(k).hide()}})}
$('.js_cart_block_form, .cart_block_form').show();$('.js_shop_form').each(function(){if($(this).find('.error').text()){$("input[name=action]",this).val('check');$(this).submit()}});if(js_cart_block_scroll>-1){$('.js_cart_block_form').each(function(){var $scroll=$(this).closest('._scroll');if($scroll.length){$scroll.scrollTop(+js_cart_block_scroll)}})}
return!1}
$(document).click(function(event){if($(event.target).closest("form").length){return!0}
$('.js_cart_block_form .error').hide()});$(document).on('change','.js_cart_block_form :text, .js_cart_block_form input[type=number], .cart_block_form :text, .cart_block_form input[type=number]',function(){cart_block_submit(this)});$(document).on('click','.js_cart_block_form :checkbox, .js_cart_block_form :radio, .cart_block_form :checkbox, .cart_block_form :radio',function(){if($(this).parents('.js_cart_remove, .js_cart_wishlist').length){$(this).parents('.js_cart_remove, .js_cart_wishlist').click();return}
cart_block_submit(this)});$(document).on('change','.js_cart_block_form :checkbox, .js_cart_block_form :radio, .cart_block_form :checkbox, .cart_block_form :radio',function(){if($(this).parents('.js_cart_remove, .js_cart_wishlist').length){$(this).parents('.js_cart_remove, .js_cart_wishlist').click();return}
cart_block_submit(this)});$(document).on('click','.js_cart_block_form .js_cart_remove, .js_cart_block_form .js_cart_wishlist',function(){if($(this).attr('confirm')&&!confirm($(this).attr('confirm'))){return!1}
$(this).find('input[type=checkbox]').prop('checked',!0);$(this).find('input[type=hidden]').val(1);cart_block_submit(this)});$(document).on('click','.js_cart_block_form .js_cart_count_minus, .cart_block_form .cart_count_minus',function(){var count=$(this).parents('.js_cart_count, .cart_count').find('input');count.val().replace(/,/g,".");if(count.val()>1){count.val(count.val()*1-1)}
cart_block_submit(this)});$(document).on('click','.js_cart_block_form .js_cart_count_plus, .cart_block_form .cart_count_plus',function(){var count=$(this).parents('.js_cart_count, .cart_count').find('input');count.val().replace(/,/g,".");count.val(count.val()*1+1);cart_block_submit(this)});function cart_block_submit(child){$(child).closest('.js_cart_block_form, .cart_block_form').submit()}