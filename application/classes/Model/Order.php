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
				and ((order_status = :status1) or (order_status = :status2))
				ORDER BY delivery_date, delivery_time")
			->param(':status1', OrderStatus::NewOrder)
			->param(':status2', OrderStatus::Complected)
			->param(':userId', $UserId)
			->execute()
			->as_array('order_id');
	}
	
	public function get_order($UserId, $OrderId)
	{
		$order_detail = DB::query(Database::SELECT,
				"SELECT DISTINCT menu_record_menu_id as menu_id, orders.order_id, user_id, delivery_times_delivery_id, order_date, delivery_date,
				delivery_point, order_status, total_price, subscription_subs_id,
				delivery_time
				FROM `orders`,`delivery_times`,`orders_records`
				WHERE (user_id = :UserId) 
				AND (delivery_id = delivery_times_delivery_id)
				AND (orders.order_id = orders_records.order_id)
				AND (orders.order_id = :OrderId)")
					->param(':UserId', $UserId)
					->param(':OrderId', $OrderId)
					->execute()
					->as_array();
		if (!empty($order_detail))
		{	
			$menu_model = new Model_Menu();
			$dishes = DB::query(Database::SELECT,
			"SELECT orders_records.order_id, menu_records.menu_id, dishes.dish_id, dish_name, servings_number, price, portion_type_id as portion, type_name
					FROM orders_records, dishes, menu_records, portion_type
					WHERE dishes.dish_id = orders_records.menu_record_dish_id
					AND dishes.dish_id = menu_records.dish_id
					AND menu_records.portion_type_id = orders_records.menu_record_portion_type_id
					AND orders_records.order_id = :OrderId
					AND portion_type.id = menu_records.portion_type_id
					AND menu_id = :MenuId")
								->param(':OrderId', $OrderId)
								->param(':MenuId', $order_detail[0]['menu_id'])
								->execute()
								->as_array();
			foreach ($dishes as $key => $value)
			{
				$value['portions'] = $menu_model->get_portions($value['menu_id'], $value['dish_id']); 
				$order_detail[0]['dishes'][$value['dish_id']."|".$value['portion']] = $value;
			}
		}
		return $order_detail[0];
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
		// проверяем не отправился статус заказа, а так же принадлежность заказа пользователю  
		$result = DB::query(Database::SELECT,
			"SELECT order_id 
			FROM orders 
			WHERE (user_id = :UserId) 
			AND (order_id = :OrderId)
			AND (order_status = :status1 OR order_status = :status2)")
				->param(':status1', OrderStatus::NewOrder)
				->param(':status2', OrderStatus::Complected)
				->param(':OrderId', $OrderId)
				->param(':UserId', $UserId)
				->execute();
		if($result->count() == 1) { $this->setStatus($OrderId, OrderStatus::Canceled); return 1;}
		else {return 0;}
	}
	
	public function make_order($Order, $UserId, $MenuId ,$Delivery_date, $Delivery_point = NULL, $Delivery_time = NULL)
	{
		//TODO: доделать проверку на количество заказов на данное время
		$result = DB::query(Database::SELECT,
			"SELECT COUNT(order_id) as orders_maked, delivery_limit 
			FROM orders, delivery_times 
			WHERE (delivery_date = :DeliveryDate) 
			AND (delivery_times.delivery_id = orders.delivery_times_delivery_id) 
			AND (delivery_times.delivery_id = :DeliveryTime)
			AND (orders.order_status in (:status1,:status2))")
					->param(':DeliveryDate', $Delivery_date)
					->param(':DeliveryTime', $Delivery_time)
					->param(':status1', OrderStatus::NewOrder)
					->param(':status2', OrderStatus::Complected)
					->execute()
					->as_array();
		if ($result != null && $result[0]['orders_maked'] >= $result[0]['delivery_limit']){return 2;}
		$Total_price = 0;
		foreach ($Order as $key => $value)
		{
			$Total_price += $value['servings_number']*$value['portions'][$value['portion']]['price'];
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
				"INSERT INTO `orders_records`(menu_record_dish_id, menu_record_portion_type_id, menu_record_menu_id, order_id, servings_number)
				VALUES(:dishId,:portion,:menuId,:orderId,:servings_number)")
						->param(':dishId', $value['dish_id'])
						->param(':menuId', $MenuId)
						->param(':orderId', $result[0])
						->param(':portion', $value['portion'])
						->param(':servings_number', $value['servings_number'])
						->execute();
			}
		}
		else 
		{
			return 1;
		}
		return 0;
	}
	
	public function update_order($OrderId, $Order, $UserId, $MenuId ,$Delivery_date, $Delivery_point = NULL, $Delivery_time = NULL)
	{
		$Total_price = 0;
		foreach ($Order as $key => $value)
		{
			$Total_price += $value['servings_number']*$value['price'];
		}

		DB::query(Database::UPDATE,
			"UPDATE `orders` SET order_date=NOW(), delivery_date=:date, delivery_times_delivery_id=:time,
			delivery_point=:point, order_status=:status, total_price=:total, user_id=:user
			WHERE order_id=:orderId and user_id = :user")
				->param(':date', $Delivery_date)
				->param(':time', $Delivery_time)
				->param(':point', $Delivery_point)
				->param(':status', OrderStatus::NewOrder)
				->param(':total', $Total_price)
				->param(':user', $UserId)
				->param(':orderId', $OrderId)
				->execute();
		DB::query(Database::DELETE,
			"DELETE FROM `orders_records` WHERE order_id=:orderId")
							->param(':orderId', $OrderId)
							->execute();
			foreach ($Order as $key => $value)
			{
				DB::query(Database::INSERT,
				"INSERT INTO `orders_records`(menu_record_dish_id, menu_record_menu_id, order_id, portion_type_id, servings_number)
				VALUES(:dishId,:menuId,:orderId,:portionType,:servings_number)")
					->param(':dishId', $value['dish_id'])
					->param(':potrionType', $value['portion_type_id'])
					->param(':menuId', $MenuId)
					->param(':orderId', $OrderId)
					->param(':servings_number', $value['servings_number'])
					->execute();
			}
		return 0;
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
		$OrderStatus = DB::query(Database::SELECT, 'select order_status from orders where order_id = :ID'.$Constrain)
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