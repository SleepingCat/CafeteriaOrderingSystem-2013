<?phpdefined('SYSPATH') or die('No direct script access.');
class Model_EquipOrder
{
	public function get_period()
	{
		$delivery = DB::query(Database::SELECT, 'SELECT delivery_time, Time(delivery_time+15*100)
												FROM delivery_times
												WHERE Current_time < CAST( delivery_time +15 *100 AS TIME )
												AND Current_time >= delivery_time')
														->execute()
														->as_array();
		
		$periodOrder = $delivery[0] + ' - ' + $delivery[1];
		
		// Передаем в представление интервал времени
		$this->content = View::factory('order/equipOrder')
		->set('period',$periodOrder);
	}
	
	public function get_orders()
	{
		$orders = DB::query(Database::SELECT, 'SELECT Count(order_id), delivery_date, delivery_times_delivery_id, order_status
												FROM orders
												left join delivery_times on delivery_times.delivery_id = orders.delivery_times_delivery_id
												WHERE (Current_date = delivery_date) and (order_status = "Заказ_принят") 
												and (orders.delivery_times_delivery_id = (select delivery_id from delivery_times where Current_time < time(delivery_time +15 *100 ) 
												AND Current_time >= delivery_time))')
												->execute()
												->as_array();
		$numbOrders = $orders[0];
		
		// Передаем в представление количество заказов на данный период
		$this->content = View::factory('order/equipOrder')
		->set('nowOrders',$numbOrders);
		
		$this->content = Controller::factory('EquipOrder')
		->set('allOrders',$numbOrders);
	}
	
}
