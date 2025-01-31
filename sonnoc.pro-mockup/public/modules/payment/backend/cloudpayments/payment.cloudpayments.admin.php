<?php
/**
 * Настройки платежной системы CloudPayments для административного интерфейса
 */

if (!defined('DIAFAN')) {
    $path = __FILE__;
    while (!file_exists($path . '/includes/404.php')) {
        $parent = dirname($path);
        if ($parent == $path) {
            exit;
        }
        $path = $parent;
    }
    include $path . '/includes/404.php';
}

class Payment_cloudpayments_admin  extends Diafan {
    public $config;

    public function __construct(&$diafan) {
        parent::__construct($diafan);
        $this->config = array(
            "name"   => 'CloudPayments',
            "params" => array(
                'cloudpayments_public_id'       => array(
                    'name' => 'Идентификатор сайта',
                    'help' => 'Обязательный идентификатор сайта. Находится в ЛК CloudPayments.'
                ),
                'cloudpayments_secret_key'      => array(
                    'name' => 'Секретный ключ',
                    'help' => 'Обязательный секретный ключ. Находится в ЛК CloudPayments (Пароль для API).'
                ),
                'cloudpayments_payment_scheme' => array(
                    'name'   => 'Схема платежа',
                    'type'   => 'select',
                    'help'   => 'Схемы проведения платежа',
                    'select' => array(
                        'charge' => 'Одностадийная',
                        'auth'   => 'Двухстадийная',
                    )
                ),
                'cloudpayments_receipt'         => array(
                    'name' => 'Онлайн-касса',
                    'type' => 'checkbox',
                    'help' => 'Автоматически формировать онлайн-чек при оплате.',
                ),
                'cloudpayments_currency' => array(
                    'name'   => 'Валюта виджета',
                    'type'   => 'select',
                    'help' => 'Валюта в которой производится оплата.',
                    'select' => array(
                        'RUB' => 'Российский рубль',
                        'EUR' => 'Евро',
                        'USD' => 'Доллар США',
                        'GBP' => 'Фунт стерлингов',
                        'UAH' => 'Украинская гривна',
                        'BYN' => 'Белорусский рубль',
                        'KZT' => 'Казахский тенге',
                        'AZN' => 'Азербайджанский манат',
                        'CHF' => 'Швейцарский франк',
                        'CZK' => 'Чешская крона',
                        'CAD' => 'Канадский доллар',
                        'PLN' => 'Польский злотый',
                        'SEK' => 'Шведская крона',
                        'TRY' => 'Турецкая лира',
                        'CNY' => 'Китайский юань',
                        'INR' => 'Индийская рупия',
                        'BRL' => 'Бразильский реал',
                        'ZAL' => 'Южноафриканский рэнд',
                        'UZS' => 'Узбекский сум',
                    )
                ),
                'cloudpayments_language' => array(
                    'name'   => 'Язык виджета',
                    'type'   => 'select',
                    'help' => 'Язык интерфейса виджета',
                    'select' => array(
                        'ru-RU' => 'Русский (MSK)',
                        'en-US' => 'Английский (CET)',
                        'lv' => 'Латышский (CET)',
                        'az' => 'Азербайджанский (AZT)',
                        'kk' => 'Русский (ALMT)',
                        'kk-KZ' => 'Казахский (ALMT)',
                        'uk' => 'Украинский (EET)',
                        'pl' => 'Польский (CET)',
                        'pt' => 'Португальский (CET)',
                    )
                ),
		        'cloudpayments_skin' => array(
                    'name'   => 'Дизайн виджета',
                    'type'   => 'select',
                    'help' => 'Дизайн виджета',
                    'select' => array(
                        'classic' => 'Classic',
                        'modern' => 'Modern',
                        'mini' => 'Mini',
                    )
                ),
                'cloudpayments_taxation_system' => array(
                    'name'   => 'Система налогообложения магазина',
                    'type'   => 'select',
                    'help' => 'Система налогообложения магазина. Используется только при онлайн-кассе.',
                    'select' => array(
                        'ts_0' => 'Общая система налогообложения',
                        'ts_1' => 'Упрощенная система налогообложения (Доход)',
                        'ts_2' => 'Упрощенная система налогообложения (Доход минус Расход)',
                        'ts_3' => 'Единый налог на вмененный доход',
                        'ts_4' => 'Единый сельскохозяйственный налог',
                        'ts_5' => 'Патентная система налогообложения',
                    )
                ),
                'cloudpayments_vat'             => array(
                    'name'   => 'Ставка НДС',
                    'type'   => 'select',
                    'help' => 'Ставка НДС. Используется только при онлайн-кассе.',
                    'select' => array(
                        'vat_none' => 'НДС не облагается',
                        'vat_0'    => 'НДС 0%',
                        'vat_10'   => 'НДС 10%',
                        'vat_20'   => 'НДС 20%',
                        'vat_110'  => 'Расчетный НДС 10/110',
                        'vat_120'  => 'Расчетный НДС 20/120',
                    ),
                ),
                'cloudpayments_vat_delivery'             => array(
                    'name'   => 'Ставка НДС для доставки',
                    'type'   => 'select',
                    'help' => 'Ставка НДС для доставки. Используется только при онлайн-кассе.',
                    'select' => array(
                        'vat_none' => 'НДС не облагается',
                        'vat_0'    => 'НДС 0%',
                        'vat_10'   => 'НДС 10%',
                        'vat_20'   => 'НДС 20%',
                        'vat_110'  => 'Расчетный НДС 10/110',
                        'vat_120'  => 'Расчетный НДС 20/120',
                    ),
                ),
                'cloudpayments_notify_url' => array(
                    'type' => 'function',
                ),
            )
        );
    }

    public function edit_variable_cloudpayments_notify_url() {
        echo '<div class="infofield">'
              . 'URL для уведомлений <i class="tooltip fa fa-question-circle" title="Скопируйте и вставьте в соответствующие поля в ЛК CloudPayments"></i>'
              . '</div>';
        $baseUrl = BASE_PATH . 'payment/get/cloudpayments/';
        foreach (array('check', 'pay', 'fail', 'refund', 'confirm', 'cancel') as $url) {
            echo '<div class="unit">'
                . '<p><b style="display:inline-block;width:50px;">' . ucfirst($url) . '</b>   <input readonly value="' . $baseUrl . $url . '"</p>'
                . '<p><pre id="test_check"></pre></p>'
                . '</div>';
        }
    }

}