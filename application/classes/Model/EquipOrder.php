<?php defined('SYSPATH') or die('No direct script access.');
class Model_EquipOrder
{
	public function get_period()
	{
		$delivery = DB::query(Database::SELECT, 'SELECT concat(delivery_time, "-", Time(delivery_time+15*100)) as DeliverPeriod
												FROM delivery_times
												WHERE Current_time < CAST( delivery_time +15 *100 AS TIME )
												AND Current_time >= delivery_time')
														->execute()
														->get('DeliverPeriod');
		/*if (!$delivery = null)
		{
			$firstTime = $delivery[0];
			$secondTime = $delivery[1];
		}
		else 
		{
			$firstTime = "Нет заказов на текущий период";
		}*/
		return $delivery;
		//здесь не нужно
		// Передаем в представление интервал времени
		//$this->content = View::factory('order/equipOrder')
		//->set('startTime',$firstTime)
		//->set('endTime',$secondTime);
	}
	
	public function get_orders()
	{
		$orders = DB::query(Database::SELECT, 'SELECT Count(order_id) as COUNT, delivery_date, delivery_times_delivery_id, delivery_times.delivery_limit
												FROM orders
												left join delivery_times on delivery_times.delivery_id = orders.delivery_times_delivery_id
												WHERE (Current_date = delivery_date) and (order_status = "Заказ_принят") 
												and (orders.delivery_times_delivery_id = (select delivery_id from delivery_times where Current_time < time(delivery_time +15 *100 ) 
												AND Current_time >= delivery_time))')
												->execute()
		                                        ->as_array();
		//$numbOrders = $orders[0];
		return $orders;

		//Это не нужно во вью мы посылаем данные из контрола
		// Передаем в представление количество заказов на данный период
		//$this->content = View::factory('order/equipOrder')
		//->set('nowOrders',$numbOrders);
	}
	
}
