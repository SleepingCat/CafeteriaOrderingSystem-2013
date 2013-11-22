<?php defined('SYSPATH') or die('No direct script access.');

class Controller_EquipOrder extends Controller_Front
{
	public function action_index()
	{
		//Получаем интервал для комплектования блюд
		$per = new Model_EquipOrder();
		$periods = $per -> get_period();
		
		//Получаем общее количество комплектующихся блюд на текущий интервал времени
		$ord = new Model_EquipOrder();
		$orders = $ord -> get_orders();
		
		//Получаем оставшееся количество блюд для комплектования
		$leftOrders = new Model_EquipOrder();
		$leftOrd = $leftOrders ->leftOrders();
		
		$this->title = "Укомплектовать заказы";
		
		//Передаем полученные данные во вьюху
		$this->content = View::factory('order/equipOrder')
		  ->set("startTime",$periods)
		  ->set('nowOrders', $orders )
		  ->set('leftOrders', $leftOrd);
	}
	
	public function action_equipOrGetContent()
	{
		if (@$_POST['getOrder'])
		{
			//Получаем ближайший заказ для комплектования
			$minOrd = new Model_EquipOrder();
			$getOrd = $minOrd -> immidiateOrder();
			
			//Получаем заказчика
			$getDishes = new Model_EquipOrder();
			$Buyer = $getDishes -> getBuyer($getOrd);
			
			$this->title = "Укомплектовать заказы";
			
			//Передаем полученные данные во вьюху
			$this->content = View::factory('order/getOrder')
			->set('orderID', $getOrd)
			->set('owner', $Buyer);
		}
	    elseif (@$_POST['equip'])
		{
			//Получаем ближайший заказ для комплектования
			$status = new Model_EquipOrder();
			$setStatus = $status -> immidiateOrder();
			
			//Устанавливаем статус "Укомплектован"
			$q = DB::query(Database::UPDATE, 'Update orders set order_status = "Укомплектован" where order_id = :id ')
			->param(':id', $setStatus)
			->execute();
			
			$this -> redirect('EquipOrder');
			
			//Передаем полученные данные во вьюху
			$this->content = View::factory('order/equipOrder')
			->set("startTime",$periods)
			->set('nowOrders', $orders )
			->set('leftOrders', $leftOrd);
		}
		elseif (@$_POST['cancel'])
		{
			$this -> redirect('EquipOrder');
		}
		elseif (@$_POST['showOrder'])
		{
			//Получаем ближайший заказ для комплектования
			$minOrd = new Model_EquipOrder();
			$getOrd = $minOrd -> immidiateOrder();
				
			//Получаем список блюд в заказе
			$getDishes = new Model_EquipOrder();
			$Dishes = $getDishes -> getDishes($getOrd);
				
			$this->title = "Укомплектовать заказы";
				
			//Передаем полученные данные во вьюху
			$this->content = View::factory('order/listOrder')
			->set('orderID', $getOrd)
			->set('owner', $Dishes);
		}
	}
}