<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Перечисление состояний заказа
 * Использование OrderStatus::NewOrder
 * @author Kenny
 *
 */
class OrderStatus
{
	const NewOrder = "NewOrder";
	const InComplectation = "InComplectation";
	const Canceled = "Canceled";
	const NotComplectated = "Не укомплектован";
	const Complectated = "Укомплектован";
}

?>