<?php defined('SYSPATH') or die('No direct script access.');
class Model_EquipOrder
{
	public function get_period()
	{
		$delivery = DB::query(Database::SELECT, 'SELECT concat(delivery_time, " - ", Time(delivery_time+15*100)) as DeliverPeriod
												FROM delivery_times
												WHERE Current_time < CAST( delivery_time +15 *100 AS TIME )
												AND Current_time >= delivery_time')
														->execute()
														->get('DeliverPeriod');
		
		return $delivery;

	}
	
	public function get_orders()
	{
		$orders = DB::query(Database::SELECT, 'SELECT Count(order_id) as COUNT
												FROM orders
												left join delivery_times on delivery_times.delivery_id = orders.delivery_times_delivery_id
												WHERE (Current_date = delivery_date)
												and (orders.delivery_times_delivery_id = (select delivery_id from delivery_times where Current_time < time(delivery_time +15 *100 ) 
												AND Current_time >= delivery_time))')
												->execute()
		                                        ->get('COUNT');

		return $orders;

	}
	
	public function immidiateOrder()
	{
		$immOrder = DB::query(Database::SELECT, 'SELECT MIN(order_id) as OrdID
													FROM orders
													left join delivery_times on delivery_times.delivery_id = orders.delivery_times_delivery_id
													WHERE (Current_date = delivery_date) and (order_status = "Заказ_принят")
													and (orders.delivery_times_delivery_id = (select delivery_id from delivery_times
													where Current_time < time(delivery_time +15 *100 ) AND Current_time >= delivery_time))')
													->execute()
													->get('OrdID');
		
		return $immOrder;
	}
	
	public function leftOrders()
	{
		$leftOrd = DB::query(Database::SELECT, 'SELECT COUNT(order_id) as leftOrders
												FROM orders
												left join delivery_times on delivery_times.delivery_id = orders.delivery_times_delivery_id
												WHERE (Current_date = delivery_date) and (order_status = "Заказ_принят")
												and (orders.delivery_times_delivery_id = (select delivery_id from delivery_times where Current_time < time(delivery_time +15 *100 ) 
												AND Current_time >= delivery_time))')
												->execute()
												->get('leftOrders');
		
		return $leftOrd;
	}
	
	public function getDishes($ID)
	{
		$dishes = DB::query(Database::SELECT, 'select dishes.dish_name
												from dishes
												join menu_records MR on MR.dish_id = dishes.dish_id
												join orders_records OrRec on OrRec.menu_record_menu_id = MR.menu_id
												join orders on orders.order_id = OrRec.order_id
												where orders.order_id = :id')
												->param(':id',$ID)
												->execute()
												->as_array();
		
		$setState = DB::query(Database::UPDATE, 'Update orders set order_status = "Укомплектован" where order_id = :id')
		->param(':id', $ID)
		->execute();
		
		return $dishes;
	}
	
}
