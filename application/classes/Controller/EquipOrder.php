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
		
		$this->content = View::factory('order/equipOrder')
		  ->set("startTime",$periods)
		  ->set('nowOrders', $orders )
		  ->set('leftOrders', $orders);
	}
	
	public function action_equipOrGetContent()
	{
		if (@$_POST['getOrder'])
		{
			$status = new Model_EquipOrder();
			$setStatus = $status -> immidiateOrder();
			
			$q = DB::query(Database::UPDATE, 'Update orders set order_status = "Укомплектован" where order_id = :id ')
			->param(':id', $setStatus)
			->execute();
		}
		else if (@$_POST['showOrder'])
		{
			
		}
	}
}