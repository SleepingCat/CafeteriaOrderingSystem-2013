<?php defined('SYSPATH') or die('No direct script access.');
class Model_Order extends Model
{
	public function get_orders($UserId)
	{
		return DB::query(Database::SELECT, 
				"SELECT *
				FROM `orders`
				WHERE (user_id = :userId)
				and (order_status != 'canceled')")
			->param(':userId', 1)
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
			"UPDATE `orders` SET order_status = 'canceled' 
			WHERE (order_id = :OrderId) and (user_id = :UserId)")
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
			VALUES(NOW(), :date, :time, :point, 'new', :total, :user)")
					->param(':date', $Delivery_date)
					->param(':time', $Delivery_time)
					->param(':point', $Delivery_point)
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
}