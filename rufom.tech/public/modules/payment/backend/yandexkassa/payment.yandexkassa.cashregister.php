<?php
/**
 * Онлайн касса платежного метода «Яндекс.Касса»
 *
 * @package    DIAFAN.CMS
 * @author     diafan.ru
 * @version    6.0
 * @license    http://www.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2019 OOO «Диафан» (http://www.diafan.ru/)
 */

if ( ! defined('DIAFAN'))
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

class Payment_yandexkassa_cashregister extends Diafan
{
    /**
     * Чек «Полная оплата»
	 *
     * @param array $info данные о заказе
     * @return string  Уникальный идентификатор чека
     * @throws YandexkassaException
     */
    public function sell($info)
    {
        if (empty($info["payment"]["params"]["kkt"]))
		{
            throw new YandexkassaException('Ошибка: Отключена настройка «Отправлять в Яндекс.Кассу данные для чеков (54-ФЗ)». Отключите отправление чеков через платежный модуль в настройках модуля «Онлайн касса».', 0);
        }
        if (empty($info["payment"]["params"]["shop_id"]))
		{
            throw new YandexkassaException('Ошибка: Не заполнена настройка shopId для платежного метода «Яндекс.Касса».', 0);
        }
        if (empty($info["payment"]["params"]["password"]))
		{
            throw new YandexkassaException('Ошибка: Не заполнена настройка «Секретный ключ» для платежного метода «Яндекс.Касса».', 0);
        }
        if (empty($info["payment"]["params"]["vat_code"]))
		{
            throw new YandexkassaException('Ошибка: Не заполнена настройка «НДС» для платежного метода «Яндекс.Касса».', 0);
        }
		
        if ($info["phone"])
		{
            $info["phone"] = preg_replace('/\D/', '', $info["phone"]);
            if (strlen($info["phone"]) == 11 && $info["phone"][0] == '8')
			{
                $info["phone"][0] = '7';
            }
        }
		
        $request = array(
			'type' => 'payment',
			'payment_id' => $info["payment"]["payment_data"],
            'customer' => array(
                'email' => $info["email"],
                'phone' => $info["phone"],
            ),
            'tax_system_code' => (! empty($info["payment"]["params"]["tax_system_code"]) ? $info["payment"]["params"]["tax_system_code"] : ''),
			'send' => true,
            'settlements' => array(
				array(
					"type" => "prepayment",
					"amount" => array
					(
					  "value" => $this->format($info["summ"]),
					  "currency" => "RUB"
					),
				),
			),
            'items' => array(),
        );
        $items = array();
        foreach ($info['rows'] as $row)
        {
            $items[] = array(
				"description" => $row['name'].(! empty($row["article"]) ? ' '.$row["article"] : ''),
				"quantity" => $this->format($row['count']),
				"amount" => array(
				  "value" => $this->format($row['price']),
				  "currency" => "RUB"
				),
				"vat_code" => $info["payment"]["params"]["vat_code"],
				"payment_subject" => (! empty($row["is_delivery"]) ? 'service' : 'commodity'),
				"payment_mode" => "full_payment",
            );
        }
        $request["items"] = $items;
		
		$header = array(
			'Content-Type: application/json',
			'Idempotence-Key: '.$info["cashregister_id"]
        );
	
		$response = $this->diafan->fast_request("https://payment.yandex.net/api/v3/receipts", $request, $header, false, ( REQUEST_POST_JSON | REQUEST_ANSWER ), $info["payment"]["params"]["shop_id"].':'.$info["payment"]["params"]["password"]);
		
		$response = json_decode($response, true);

        if (! empty($response["type"]) && $response["type"] == "error")
		{
            throw new YandexkassaException('Ошибка: '.$response["description"], 0);
        }

        return $response['id'];
    }
	
	private function format($summ)
	{
		return number_format($summ, 2, '.', '');
	}
}

class YandexkassaException extends Exception{}
