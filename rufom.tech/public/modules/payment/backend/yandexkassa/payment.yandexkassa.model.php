<?php
/**
 * Формирует данные для формы платежной системы Яндекс.Касса
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

class Payment_yandexkassa_model extends Diafan
{
	/**
     * Формирует данные для формы платежной системы "YandexMoney"
     * 
     * @param array $params настройки платежной системы
     * @param array $pay данные о платеже
     * @return array
     */
	public function get($params, $pay)
	{
        if (empty($params["shop_id"]))
		{
           $result["text"] = $this->diafan->_('Ошибка: Не заполнена настройка shopId для платежного метода «Яндекс.Касса».');
		   return $result;
        }
        if (empty($params["password"]))
		{
            $result["text"] = $this->diafan->_('Ошибка: Не заполнена настройка «Секретный ключ» для платежного метода «Яндекс.Касса».');
		   return $result;
        }
        if (! empty($params["kkt"]) && empty($params["vat_code"]))
		{
            $result["text"] = $this->diafan->_('Ошибка: Не заполнена настройка «НДС» для платежного метода «Яндекс.Касса».');
		   return $result;
        }
        $request = array(
			"amount" => array(
			  "value" => $this->format($pay["summ"]),
			  "currency" => "RUB"
			),
			'description' => $pay["desc"],
			"confirmation" => array(
				"type" => "redirect",
				"return_url" => BASE_PATH_HREF."payment/get/yandexkassa/".$pay["id"].'/',
			),
        );
		
		$email = '';
		if(! empty($pay["details"]["email"]))
		{
			$email = explode(' ', $pay["details"]["email"]);
		}
		$phone = '';
		if(! empty($pay["details"]["phone"]))
		{
            $phone = preg_replace('/\D/', '', $pay["details"]["phone"]);
            if (strlen($phone) == 11 && $phone[0] == '8')
			{
                $phone[0] = '7';
            }
		}
		if(! empty($params["kkt"]))
		{
			// если в модуле онлайн касса настроены статусы предоплаты, значит проводим в чеке предоплату
			if($this->diafan->configmodules("status_presell", "cashregister"))
			{
				$payment_mode = 'full_prepayment';
			}
			else
			{
				$payment_mode = 'full_payment';
			}
			
			$request['customer'] = array(
                'email' => $email,
                'phone' => $phone,
            );
			$request['tax_system_code'] = (! empty($params["tax_system_code"]) ? $params["tax_system_code"] : '');
			$request['email'] = $email;
			$request['phone'] = $phone;
			$request['items'] = array();
			$items = array();
			if(! empty($pay["details"]["goods"]))
			{
				foreach($pay["details"]["goods"] as $row)
				{
					$items[] = array(
						"description" => $row['name'].($row["article"] ? ' '.$row["article"] : ''),
						"quantity" => $this->format($row['count']),
						"amount" => array(
						  "value" => $this->format($row['price']),
						  "currency" => "RUB"
						),
						"vat_code" => $params["vat_code"],
						"payment_mode" => $payment_mode,
						"payment_subject" => "commodity",
					);
				}
			}
			if(! empty($pay["details"]["additional"]))
			{
				foreach($pay["details"]["additional"] as $row)
				{
					$items[] = array(
						"description" => $row['name'],
						"quantity" => $this->format(1),
						"amount" => array(
						  "value" => $this->format($row['summ']),
						  "currency" => "RUB"
						),
						"vat_code" => $params["vat_code"],
						"payment_mode" => $payment_mode,
						"payment_subject" => "commodity",
					);
				}
			}
			if(! empty($pay["details"]["delivery"]))
			{
				$items[] = array(
					"description" => $row['name'],
					"quantity" => $this->format(1),
					"amount" => array(
					  "value" => $this->format($pay["details"]["delivery"]["summ"]),
					  "currency" => "RUB"
					),
					"vat_code" => $params["vat_code"],
					"payment_mode" => $payment_mode,
					"payment_subject" => "service",
				);
			}
			$request["items"] = $items;
		}

		$header = array(
			'Content-Type: application/json',
			'Idempotence-Key: '.$pay["id"]
        );
	
		$response = $this->diafan->fast_request("https://payment.yandex.net/api/v3/payments", $request, $header, false, ( REQUEST_POST_JSON | REQUEST_ANSWER), $params["shop_id"].':'.$params["password"]);
		
		$response = json_decode($response, true);

        if (! empty($response["type"]) && $response["type"] == "error")
		{
            $result["text"] = $this->diafan->_('Ошибка').': '.$response["description"];
			return $result;
        }
		if(! empty($response["id"]))
		{
			DB::query("UPDATE {payment_history} SET payment_data='%s' WHERE id=%d", $response["id"], $pay["id"]);
		}
		if(! empty($response["confirmation"]["confirmation_url"]))
		{
			$this->diafan->redirect($response["confirmation"]["confirmation_url"]);
		}
	}
	
	private function format($summ)
	{
		return number_format($summ, 2, '.', '');
	}
}