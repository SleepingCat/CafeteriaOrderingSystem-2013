<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Перечисление состояний заказа
 * Использование OrderStatus::NewOrder
 * @author Kenny
 *
 */
class OrderStatus
{
    const NewOrder = "Размещен";
    const Complected = "Укомплектован";
	const Canceled = "Отменен";
	const NotDelivered = "Не доставлен";
	const Delivered = "Доставлен";
	const Completed = "Выполнен";
	const Paymented = "Оплачен";
}

?>