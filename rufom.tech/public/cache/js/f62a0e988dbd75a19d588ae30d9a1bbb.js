/**
 * JS-сценарий для reCAPTCHA v3
 * 
 * @package    DIAFAN.CMS
 * @author     diafan.ru
 * @version    6.0
 * @license    http://www.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2019 OOO «Диафан» (http://www.diafan.ru/)
 */
$(document).off('submit','form.ajax');$(document).on('submit','form.ajax',function(){var form=this;var recaptcha3=$(this).find('.js_recaptcha3');if(recaptcha3.length){grecaptcha.ready(function(){grecaptcha.execute(recaptcha3.data("public_key"),{action:recaptcha3.attr("id")}).then(function(token){$('#'+recaptcha3.attr("id")).val(token);return diafan_ajax.init(form)})});return!1}else{return diafan_ajax.init(this)}})