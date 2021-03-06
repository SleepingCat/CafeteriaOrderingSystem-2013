<?php defined('SYSPATH') or die('No direct script access.');
class Model_EquipOrder
{
	public function get_period()
	{
		$delivery = DB::query(Database::SELECT, 'SELECT DISTINCT MIN(concat(delivery_time, " - ", Time(delivery_time+15*100))) as DeliverPeriod
												FROM delivery_times
												JOIN orders on delivery_times.delivery_id = orders.delivery_times_delivery_id
												WHERE orders.order_status = "Размещен" and CURRENT_DATE = delivery_date')
														->execute()
														->get('DeliverPeriod');
		
		return $delivery;

	}
	
	public function get_orders()
	{
		$orders = DB::query(Database::SELECT, 'SELECT Count(order_id) as COUNT
												FROM orders
												join delivery_times on delivery_times.delivery_id = orders.delivery_times_delivery_id
												WHERE (Current_date = delivery_date)
												and delivery_times.delivery_id = 
														(select MIN(delivery_id) 
														from delivery_times 
														join orders on delivery_times.delivery_id = orders.delivery_times_delivery_id
														where orders.order_status = "Размещен" and (Current_date = delivery_date))')
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
														WHERE orders.order_status = "Размещен" and (Current_date = delivery_date)))')
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
												and (orders.delivery_times_delivery_id = 
														(select MIN(delivery_id) from delivery_times 
														join orders on orders.delivery_times_delivery_id = delivery_times.delivery_id
														WHERE orders.order_status = "Размещен" and (Current_date = delivery_date)))')
												->execute()
												->get('leftOrders');
		
		return $leftOrd;
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
	
		return $dishes;
	}
	
	public function getEquipOrder()
	{
		$orders = DB::query(Database::SELECT, 'select order_id, concat(delivery_time, " - ", Time(delivery_time+15*100)) as delivery_period, delivery_date, order_status from orders
												join delivery_times DT on DT.delivery_id = orders.delivery_times_delivery_id
												where order_status = "Укомплектован" and CURRENT_DATE = delivery_date')
												->execute()
												->as_array();
		return $orders;
	}
	
	public function showEquipOrder($ID)
	{
		$eqOrder = DB::query(Database::SELECT, 'select orders.order_id, orders.order_status, orders.delivery_date, concat(delivery_time, " - ", Time(delivery_time+15*100)) as DeliveryPeriod, CONCAT(users.surname, "  ", users.`name`, "  ", users.patronymic) as Buyer, users.building, users.floor, users.office, dishes.dish_name, OrRec.servings_number, MR.price
												from orders
												join delivery_times DT on orders.delivery_times_delivery_id = DT.delivery_id
												join orders_records OrRec on OrRec.order_id = orders.order_id
												join menu_records MR on OrRec.menu_record_menu_id = MR.menu_id
												join users on users.id = orders.user_id
												join dishes on MR.dish_id = dishes.dish_id
												where orders.order_id = :id')
												->param(':id', $ID)
												->execute()
												->as_array();
		
		return $eqOrder;
	}
	
}
