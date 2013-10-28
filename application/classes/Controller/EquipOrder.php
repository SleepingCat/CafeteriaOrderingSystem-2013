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
		//Еслы была нажата кнопка "Получить заказ для комплектования"
		if (@$_POST['getOrder'])
		{
			//Получаем ближайший заказ для комплектования
			$status = new Model_EquipOrder();
			$setStatus = $status -> immidiateOrder();
			
			//Устанавливаем статус "Укомплектован"
			$q = DB::query(Database::UPDATE, 'Update orders set order_status = "Укомплектован" where order_id = :id ')
			->param(':id', $setStatus)
			->execute();
			
			//Получаем интервал для комплектования блюд
			$per = new Model_EquipOrder();
			$periods = $per -> get_period();
			
			//Получаем общее количество комплектующихся блюд на текущий интервал времени
			$ord = new Model_EquipOrder();
			$orders = $ord -> get_orders();
			
			//Получаем оставшееся количество блюд для комплектования
			$leftOrders = new Model_EquipOrder();
			$leftOrd = $leftOrders ->leftOrders();
			
			//Передаем полученные данные во вьюху
			$this->content = View::factory('order/equipOrder')
			->set("startTime",$periods)
			->set('nowOrders', $orders )
			->set('leftOrders', $leftOrd);
			
		}
		//Если была нажата кнопка "Просмотреть заказ"
		else if (@$_POST['showOrder'])
		{
			//Получаем ближайший заказ для комплектования
			$minOrd = new Model_EquipOrder();
			$getOrd = $minOrd -> immidiateOrder();
			
			//Получаем список блюд в заказе
			$getDishes = new Model_EquipOrder();
			$Dishes = $getDishes -> getDishes($getOrd);
			
		}
	}
}