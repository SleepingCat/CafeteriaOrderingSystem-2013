<?php defined('SYSPATH') or die('No direct script access.');
class Model_EquipOrder
{
	public function get_period()
	{
		$delivery = DB::query(Database::SELECT, 'SELECT DISTINCT MIN(concat(delivery_time, " - ", Time(delivery_time+15*100))) as DeliverPeriod
												FROM delivery_times
												JOIN orders on delivery_times.delivery_id = orders.delivery_times_delivery_id
												WHERE orders.order_status = "Размещен"')
														->execute()
														->get('DeliverPeriod');
		
		return $delivery;

	}
	
	public function get_orders()
	{
		$orders = DB::query(Database::SELECT, 'SELECT Count(order_id) as COUNT
												FROM orders
												join delivery_times on delivery_times.delivery_id = orders.delivery_times_delivery_id
												WHERE (Current_date = delivery_date) and 
													(orders.delivery_point <> "0") and delivery_times.delivery_id = 
															(select MIN(delivery_id) 
															from delivery_times 
															join orders on delivery_times.delivery_id = orders.delivery_times_delivery_id
															where orders.order_status = "Размещен" or orders.order_status = "Укомплектован" or orders.order_status = "Доставлен")')
												->execute()
		                                        ->get('COUNT');

		return $orders;

	}
	
	public function immidiateOrder()
	{
		$immOrder = DB::query(Database::SELECT, 'SELECT MIN(order_id) as OrdID
													FROM orders
													join delivery_times on delivery_times.delivery_id = orders.delivery_times_delivery_id
													WHERE (Current_date = delivery_date) and (order_status = "Размещен")
													and (orders.delivery_times_delivery_id = (select MIN(delivery_id) from delivery_times 
														join orders on orders.delivery_times_delivery_id = delivery_times.delivery_id
														WHERE orders.order_status = "Размещен"))')
													->execute()
													->get('OrdID');
		
		return $immOrder;
	}
	
	public function leftOrders()
	{
		$leftOrd = DB::query(Database::SELECT, 'SELECT COUNT(order_id) as leftOrders
												FROM orders
												join delivery_times on delivery_times.delivery_id = orders.delivery_times_delivery_id
												WHERE (Current_date = delivery_date) and (order_status = "Размещен")
												and (orders.delivery_times_delivery_id = (select MIN(delivery_id) from delivery_times 
														join orders on orders.delivery_times_delivery_id = delivery_times.delivery_id
														WHERE orders.order_status = "Размещен"))')
												->execute()
												->get('leftOrders');
		
		return $leftOrd;
	}
	
	public function getBuyer($ID)
	{
		$buyer = DB::query(Database::SELECT, 'SELECT DISTINCT CONCAT(users.surname, "  ", users.`name`, "  ", users.patronymic) as Buyer, users.building, users.floor, users.office
												from users
												join orders on orders.user_id = users.id
												where orders.order_id = :id')
												->param(':id',$ID)
												->execute()
												->as_array();
		
		return $buyer;
	}
	
	public function getDishes($ID)
	{
		$dishes = DB::query(Database::SELECT, 'select distinct dishes.dish_name, CONCAT(users.surname, "  ", users.`name`, "  ", users.patronymic) as Buyer, users.building, users.floor, users.office, OrRec.servings_number, MR.price
												from dishes
												join menu_records MR on MR.dish_id = dishes.dish_id
												join orders_records OrRec on OrRec.menu_record_menu_id = MR.menu_id
												join orders on orders.order_id = OrRec.order_id
												join users on users.id = orders.user_id
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
