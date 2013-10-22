<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Модель таблицы order
 * @author Babur
 *
 */
class Model_Order extends ORM
{
<<<<<<< Updated upstream
=======
	public function get_orders($UserId)
	{
		return DB::query(Database::SELECT, 
				"SELECT order_id, user_id, delivery_times_delivery_id, order_date, delivery_date,
				delivery_point, order_status, total_price, subscription_subs_id, 
				delivery_time
				FROM `orders`,`delivery_times`
				WHERE (user_id = :userId) and (delivery_id = delivery_times_delivery_id)
				and (order_status != 'canceled')")
			->param(':userId', $UserId)
			->execute()
			->as_array('order_id');
	}
>>>>>>> Stashed changes
	
	protected $_table_name='orders';
	
    /**
     * Находит заказ по номеру возвращает его текущий статус
     * @param unknown $ID  номер заказ
     * @return Ambigous <$this, Database_Query>
     */
	public  function  findOrder($ID)
	{
<<<<<<< Updated upstream
		$OrderStatus = DB::query(Database::SELECT, 'select order_status from Orders where order_id = :ID')
		-> param(':ID', $ID);
		return $OrderStatus;
=======
		$result = DB::query(Database::UPDATE,
			"UPDATE `orders` SET order_status = :status
			WHERE (order_id = :OrderId) and (user_id = :UserId)")
					->param(':status', OrderStatus::Canceled)
					->param(':OrderId', $OrderId)
					->param(':UserId', $UserId)
					->execute();
>>>>>>> Stashed changes
	}
	
	/**
	 * Устанавливает статус заказа
	 * @param unknown $ID - номер заказа
	 * @param unknown $UpdStatus - статус, который нужно установаить
	 */
	public  function  setStatus($ID,$UpdStatus)
	{
<<<<<<< Updated upstream
	    DB::query(Database::UPDATE, 'update Orders set order_status = :St where order_id = :ID') 
		-> param(':ID', $ID)
		-> param(':St', $UpdStatus);
=======
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
>>>>>>> Stashed changes
	}
	
}


