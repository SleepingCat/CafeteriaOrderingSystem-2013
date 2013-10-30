<?php defined('SYSPATH') or die('No direct script access.');
class Model_Order extends Model
{
	public function get_orders($UserId)
	{
		return DB::query(Database::SELECT, 
				"SELECT order_id, user_id, delivery_times_delivery_id, order_date, delivery_date,
				delivery_point, order_status, total_price, subscription_subs_id, 
				delivery_time
				FROM `orders`,`delivery_times`
				WHERE (user_id = :userId) and (delivery_id = delivery_times_delivery_id)
				and (order_status != :status)")
			->param(':status', OrderStatus::Canceled)
			->param(':userId', $UserId)
			->execute()
			->as_array('order_id');
	}
	
	public function get_delivery_periods()
	{
		return DB::query(Database::SELECT, 
				'SELECT *
				FROM `delivery_times`')
			->execute()
			->as_array('delivery_id');
	}
	
	public function cancel_order($OrderId, $UserId)
	{
		$result = DB::query(Database::UPDATE,
			"UPDATE `orders` SET order_status = :status
			WHERE (order_id = :OrderId) and (user_id = :UserId)")
					->param(':status', OrderStatus::Canceled)
					->param(':OrderId', $OrderId)
					->param(':UserId', $UserId)
					->execute();
	}
	
	public function make_order($Order, $UserId, $MenuId ,$Delivery_date, $Delivery_point = NULL, $Delivery_time = NULL)
	{
		$Total_price = 0;
		foreach ($Order as $key => $value)
		{
			$Total_price += $value['amount']*$value['price'];
		}
		$result = DB::query(Database::INSERT,
		"INSERT INTO `orders`(order_date, delivery_date, delivery_times_delivery_id,
			delivery_point, order_status, total_price, user_id )
			VALUES(NOW(), :date, :time, :point, :status, :total, :user)")
					->param(':date', $Delivery_date)
					->param(':time', $Delivery_time)
					->param(':point', $Delivery_point)
					->param(':status', OrderStatus::NewOrder)
					->param(':total', $Total_price)
					->param(':user', $UserId)
					->execute();
		// Если вставилось, то обрабатываем дальше
		if ($result[1] == 1)
		{
			foreach ($Order as $key => $value)
			{
				DB::query(Database::INSERT,
				"INSERT INTO `orders_records`(menu_record_dish_id, menu_record_menu_id, order_id, servings_number)
				VALUES(:dishId,:menuId,:orderId,:amount)")
						->param(':dishId', $key)
						->param(':menuId', $MenuId)
						->param(':orderId', $result[0])
						->param(':amount', $value['amount'])
						->execute();
			}
		}
	}
	/**
	 * Находит заказ по номеру возвращает его текущий статус
	 * @param unknown $ID номер заказ
	 * @return Ambigous <$this, Database_Query>
	 */
	public function findOrder($ID, $State = "")
	{
		$Constrain = "";
		if ($State <> "")
		{
		  $Constrain = " and order_status in (".$State.")"; 
		}
		$OrderStatus = DB::query(Database::SELECT, 'select order_status from Orders where order_id = :ID'.$Constrain)
		-> param(':ID', $ID)
		-> execute()
		->get('order_status');
		return $OrderStatus;
	}
	
	/**
	 * Устанавливает статус заказа
	 * @param unknown $ID - номер заказа
	 * @param unknown $UpdStatus - статус, который нужно установаить
	 */
	public function setStatus($ID,$UpdStatus)
	{
		DB::query(Database::UPDATE, "update `orders` set `order_status` = :St where order_id = :ID")
		-> param(':ID', $ID)
		-> param(':St', $UpdStatus)
		-> execute();
	}
}