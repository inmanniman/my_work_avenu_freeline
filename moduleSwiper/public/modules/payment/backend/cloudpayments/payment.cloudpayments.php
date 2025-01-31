<?php
/**
 * Обработка уведомлений, полученных от CloudPayments
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

const CLOUDPAYMENTS_RESULT_SUCCESS             = 0;
const CLOUDPAYMENTS_RESULT_ERROR_INVALID_ORDER = 10;
const CLOUDPAYMENTS_RESULT_ERROR_INVALID_COST  = 11;
const CLOUDPAYMENTS_RESULT_ERROR_NOT_ACCEPTED  = 13;
const CLOUDPAYMENTS_RESULT_ERROR_EXPIRED       = 20;

function print_callback_response($code, $message = '') {
    header('Content-Type: application/json');
    echo json_encode(array('code' => $code, 'message' => $message));
}

function exit_with_error($code, $message = '') {
    print_callback_response($code, $message);
    die();
}

function get_pay_for_cancel($pay_id) {
    $pay = DB::query_fetch_array("SELECT * FROM {payment_history} WHERE id=%d LIMIT 1", $pay_id);
    if (!$pay)
    {
        Custom::inc('includes/404.php');
    }

    $pay["payment"] = DB::query_fetch_array("SELECT * FROM {payment} WHERE id=%d AND payment='%s' LIMIT 1", $pay["payment_id"], 'cloudpayments');
    if(!$pay["payment"])
    {
        Custom::inc('includes/404.php');
    }
    $pay["params"] = unserialize($pay["payment"]["params"]);

    return $pay;
}

function set_order_status($diafan, $status_id, $pay) {
    if($pay['module_name'] == 'cart')
    {
        $status = DB::query_fetch_array("SELECT * FROM {shop_order_status} WHERE status='%s' LIMIT 1", $status_id);
        $order = DB::query_fetch_array("SELECT * FROM {shop_order} WHERE id=%d LIMIT 1", $pay['element_id']);
        $diafan->_order->set_status($order, $status);
    }
}

function store_transaction_id($pay_id, $transaction_id)
{
    DB::query("UPDATE {payment_history} SET payment_data='%s', created=%d WHERE id=%d", $transaction_id, time(), $pay_id);
}

function get_pay_id_by_transaction_id($transaction_id)
{
    return DB::query_result("SELECT id FROM {payment_history} WHERE payment_data='%s'", $transaction_id);
}

if (isset($_POST['Data'])) {
    Custom::inc("plugins/json.php");
    $data = from_json($_POST['Data']);
    if (!empty($data['pay_id'])) {
        $pay_id = intval($data['pay_id']);
    } elseif (isset($_POST['PaymentTransactionId'])) {
        //Находим тогда по номеру транзации (для refund)
        $pay_id = get_pay_id_by_transaction_id($_POST['PaymentTransactionId']);
    }
}
if (!$pay_id) {
    exit_with_error(CLOUDPAYMENTS_RESULT_ERROR_INVALID_ORDER, "pay_id not set");
}

switch ($_GET['rewrite']) {
    case "cloudpayments/fail":
    case "cloudpayments/refund":
    case "cloudpayments/cancel":
        $pay = get_pay_for_cancel($pay_id);
        break;
    default:
        $pay = $this->diafan->_payment->check_pay($pay_id, 'cloudpayments');
}

if (!$pay) {
    exit_with_error(CLOUDPAYMENTS_RESULT_ERROR_NOT_ACCEPTED, "Payment not found");
}

// Проверяем контрольную подпись
$post_data    = file_get_contents('php://input');
$check_sign   = base64_encode(hash_hmac('SHA256', $post_data, $pay["params"]['cloudpayments_secret_key'], true));
$request_sign = isset($_SERVER['HTTP_CONTENT_HMAC']) ? $_SERVER['HTTP_CONTENT_HMAC'] : '';

if ($check_sign !== $request_sign) {
    exit_with_error(CLOUDPAYMENTS_RESULT_ERROR_NOT_ACCEPTED, "Invalid sign");
};


if (in_array($_GET['rewrite'], array('cloudpayments/check', 'cloudpayments/pay', 'cloudpayments/confirm')) && $_POST['Amount'] != $pay["summ"]) {
    exit_with_error(CLOUDPAYMENTS_RESULT_ERROR_INVALID_COST, "Invalid cost");
}

switch ($_GET['rewrite']) {
    case "cloudpayments/check":
        break;
    case "cloudpayments/pay":
        if ($_POST['Status'] == 'Completed') {
            store_transaction_id($pay_id, $_POST['TransactionId']);
            $this->diafan->_payment->success($pay, 'pay');
        }
        break;
    case "cloudpayments/confirm":
        $this->diafan->_payment->success($pay, 'pay');
        break;
    case "cloudpayments/fail":
        set_order_status($this->diafan,2, $pay);
        break;
    case "cloudpayments/refund":
        set_order_status($this->diafan,2, $pay);
        break;
    case "cloudpayments/cancel":
        set_order_status($this->diafan,2, $pay);
        break;
    default:
        exit_with_error(CLOUDPAYMENTS_RESULT_ERROR_NOT_ACCEPTED, "Wrong route");
}
print_callback_response(CLOUDPAYMENTS_RESULT_SUCCESS);
