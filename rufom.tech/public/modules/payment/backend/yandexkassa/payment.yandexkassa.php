<?php
/**
 * Работа с платежной системой Яндекс.Касса
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

$_GET["rewrite"] = str_replace('yandexkassa/', '', $_GET["rewrite"]);

if(empty($_GET["rewrite"]))
{
	Custom::inc('includes/404.php');
}

$pay = $this->diafan->_payment->check_pay($_GET["rewrite"], 'yandexkassa');

$header = array(
	'Content-Type: application/json',
	'Idempotence-Key: '.$pay["id"]
);

$response = $this->diafan->fast_request("https://payment.yandex.net/api/v3/payments/".$pay["payment_data"], false, $header, false, ( REQUEST_POST_JSON | REQUEST_ANSWER ), $pay["params"]["shop_id"].':'.$pay["params"]["password"]);

$response = json_decode($response, true);

if($response["status"] == "succeeded" || $response["status"] == "waiting_for_capture")
{
	 $this->diafan->_payment->success($pay);
}
else
{
	$this->diafan->_payment->fail($pay);
}
