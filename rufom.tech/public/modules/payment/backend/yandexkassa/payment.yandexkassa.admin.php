<?php
/**
 * Настройки платежной системы Яндекс.Касса для административного интерфейса
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

class Payment_yandexkassa_admin
{
	public $config;
	private $diafan;

	public function __construct(&$diafan)
	{
		$this->diafan = &$diafan;
		$this->config = array(
			"name" => 'Яндекс.Касса',
			"params" => array(
				'shop_id' => 'shopId',
				'password' => 'Секретный ключ',
				'kkt' => array(
					'name' => 'Отправлять в Яндекс.Кассу данные для чеков (54-ФЗ)',
					'type' => 'checkbox'
				),
				'vat_code' => array(
					'name' => 'НДС',
					'type' => 'select',
					'select' => array(
						1 => 'без НДС',
						2 => 'НДС по ставке 0%',
						3 => 'НДС чека по ставке 10%',
						4 => 'НДС чека по ставке 20%',
						5 => 'НДС чека по расчетной ставке
						10/110',
						6 => 'НДС чека по расчетной ставке
						20/120',
					),
				),
				'tax_system_code' => array(
					'name' => 'Система налогообложения магазина',
					'type' => 'select',
					'select' => array(
						0 => '',
						1 => 'Общая система налогообложения',
						2 => 'Упрощенная (УСН, доходы)',
						3 => 'Упрощенная (УСН, доходы минус расходы)',
						4 => 'Единый налог на вмененный доход (ЕНВД)',
						5 => 'Единый сельскохозяйственный налог (ЕСН)',
						6 => 'Патентная система налогообложения',
					),
				),
			)
		);
	}
}