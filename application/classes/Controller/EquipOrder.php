<?php defined('SYSPATH') or die('No direct script access.');

class Controller_EquipOrder extends Controller_Front
{
	public function action_index()
	{
		$per = new Model_EquipOrder();
		$periods = $per -> get_period();
		
		$ord = new Model_EquipOrder();
		$orders = $ord -> get_orders();
		$this->title = "Укомплектовать заказы";
		//Незнаю что будет в nowOrders поэтому там заглушка
		$this->content = View::factory('order/equipOrder')->set("startTime",$periods)
		  ->set('nowOrders', $orders );
	}
}