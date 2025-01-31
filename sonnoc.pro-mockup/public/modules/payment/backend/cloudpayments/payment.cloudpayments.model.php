<?php
/**
 * Формирует данные для виджета CloudPayments
 */

if (!defined("DIAFAN")) {
    $path = __FILE__;
    while (!file_exists($path . "/includes/404.php")) {
        $parent = dirname($path);
        if ($parent == $path) {
            exit;
        }
        $path = $parent;
    }
    include $path . "/includes/404.php";
}

class Payment_cloudpayments_model extends Diafan {
    /**
     * Формирует данные для формы платежной системы "CloudPayments"
     *
     * @param array $params настройки платежной системы
     * @param array $pay    данные о платеже
     * @return array
     * @throws Exception
     */
    public function get($params, $pay) {
        $customer_email = isset($pay["details"]["email"]) ? $pay["details"]["email"] : "";
        $customer_phone = isset($pay["details"]["phone"]) ? $pay["details"]["phone"] : "";
        $customer_phone = preg_replace('/[^0-9]+/', '', $customer_phone);
        $customer_name  = isset($pay["details"]["name"]) ? $pay["details"]["name"] . ' ' : '';

        $widget_params = array(
            "publicId"    => $params["cloudpayments_public_id"],  //id из личного кабинета
            "description" => $pay["desc"], //назначение
            "amount"      => floatval($pay["summ"]), //сумма
            "currency"    => $params["cloudpayments_currency"], //валюта
	        "skin"        => $params["cloudpayments_skin"],
            "invoiceId"   => $pay["element_id"], //номер заказа  (необязательно)
            "accountId"   => $customer_email, //идентификатор плательщика (необязательно)
            "email"       => $customer_email,
            "data"        => array(
                "name"          => $customer_name,
                "phone"         => $customer_phone,
                "pay_id"        => $pay["id"],
                "cloudPayments" => array(),
            )
        );

        if (!empty($params["cloudpayments_receipt"])) {
            $widget_params["data"]["cloudPayments"]["customerReceipt"] = $this->get_receipt($params, $pay, $customer_email, $customer_phone);
        }

        $cart_rewrite = DB::query_result("SELECT rewrite FROM {rewrite} WHERE module_name='site' AND trash='0' AND element_type='element' AND element_id IN (SELECT id FROM {site} WHERE module_name='%s' AND [act]='1' AND trash='0')",
            $pay['module_name']);

        Custom::inc("plugins/json.php");
        $result = array(
            "text"          => $pay["text"],
            "lang"          => $params["cloudpayments_language"],
            "payment_scheme"=> $params["cloudpayments_payment_scheme"],
            "success_url"   => BASE_PATH_HREF . $cart_rewrite . "/step3/",
            "fail_url"      => BASE_PATH_HREF . $cart_rewrite . "/step4/",
            "widget_params" => to_json($widget_params),
        );

        return $result;
    }

    private function get_receipt($params, $pay, $customer_email, $customer_phone) {
        $customer_receipt = array(
            'Items'          => array(),
            'taxationSystem' => str_replace("ts_", "", $params['cloudpayments_taxation_system']),
	        'calculationPlace'=>'www.'.$_SERVER['SERVER_NAME'],
            'email'          => $customer_email,
            'phone'          => $customer_phone,
            'amounts'        => array(
                                "electronic" => floatval($pay["summ"]), // Сумма оплаты электронными деньгами
                                )
        );

        $items = array();
        //Какая-то проблема, если в селекте в настройках встречается 0, поэтому все настройки с префиксом
        $vat = str_replace("vat_", "", $params["cloudpayments_vat"]);
        if ($vat == "none") {
            $vat = "";
        }

        //Распраделяем скидку по товарам
        if (!empty($pay["details"]["discount"])) {
            $s = 0;
            foreach ($pay["details"]["goods"] as &$r) {
                $s += $r["summ"];
            }
            $orderSumm = $pay["summ"];
            if (!empty($pay["details"]["delivery"])) {
                $orderSumm -= floatval($pay["details"]["delivery"]["summ"]);
            }
            if (!empty($pay["details"]["additional"])) {
                foreach ($pay["details"]["additional"] as $row) {
                    $orderSumm -= floatval($row["summ"]);
                }
            }
            foreach ($pay["details"]["goods"] as &$r) {
                $r["price"] = floatval($r["price"] * ($orderSumm / $s));
                $r["summ"]  = floatval($r["price"] * $r["count"]);
            }
        }

        if (!empty($pay["details"]["goods"])) {
            foreach ($pay["details"]["goods"] as $row) {
                $items[] = array(
                    "label"    => $row["name"] . ($row["article"] ? " " . $row["article"] : ""),
                    "quantity" => floatval($row["count"]),
                    "price"    => floatval($row["price"]),
                    "amount"   => floatval($row["summ"]),
                    "vat"      => $vat,
                );
            }
        }
        if (!empty($pay["details"]["additional"])) {
            foreach ($pay["details"]["additional"] as $row) {
                $items[] = array(
                    "label"    => $row["name"],
                    "quantity" => 1,
                    "price"    => floatval($row["summ"]),
                    "amount"   => floatval($row["summ"]),
                    "vat"      => $vat,
                );
            }
        }
        if (!empty($pay["details"]["delivery"])) {
            $vat_delivery = str_replace("vat_", "", $params["cloudpayments_vat_delivery"]);
            if ($vat_delivery == "none") {
                $vat_delivery = "";
            }
            $items[] = array(
                "label"    => $this->diafan->_("Доставка", false),
                "quantity" => 1,
                "price"    => floatval($pay["details"]["delivery"]["summ"]),
                "amount"   => floatval($pay["details"]["delivery"]["summ"]),
                "vat"      => $vat_delivery,
            );
        }

        $customer_receipt['Items'] = $items;

        return $customer_receipt;
    }
}