<?php defined('SYSPATH') or die('No direct script access.');

class Controller_EquipOrder extends Controller_Front
{
	action_index()
	{
		$delivery = DB::query(Database::SELECT, 'SELECT Current_time AS TIME, delivery_time, CAST( delivery_time +15 *100 AS TIME ), delivery_limit 
								FROM delivery_times
								WHERE Current_time < CAST( delivery_time +15 *100 AS TIME ) 
								AND Current_time >= delivery_time')
		->execute()
		->as_array();
		
		$periodOrder = $delivery[0] + ' - ' + $delivery[1];
		
		// Передаем в представление интервал времени и количество заказов
		$this->content = View::factory('order/equipOrder')
			->set('period',$periodOrder)
			->set('maxOrder', $delivery[2]);
	}
	
	/*public class action_Equip()
	{
		
	}*/
}