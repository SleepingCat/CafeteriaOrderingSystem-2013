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
			//Получаем интервал для комплектования блюд
			$per = new Model_EquipOrder();
			$periods = $per -> get_period();
			
			//Получаем ближайший заказ для комплектования
			$minOrd = new Model_EquipOrder();
			$getOrd = $minOrd -> immidiateOrder();
			
			//Получаем заказачика и список блюд в заказе
			$getDishes = new Model_EquipOrder();
			$Dishes = $getDishes -> getDishes($getOrd);
			
			$this->title = "Укомплектовать заказы";
			
			//Передаем полученные данные во вьюху
			$this->content = View::factory('order/getOrder')
			->set('period', $periods)
			->set('orderID', $getOrd)
			->set('owner', $Dishes);
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
			
		}
		elseif(@$_POST['showLastEquip'])
		{
			//Получаем список укомплектованных заказов на текущую дату
			$equip = new Model_EquipOrder();
			$eqOrd = $equip -> getEquipOrder();
			$_SESSION['list_of_orders'] = $eqOrd;
			
			$this -> title = "Укомплектованные заказы";
			
			$this->content = View::factory('order/showEquipOrder')
			->set("list", $_SESSION['list_of_orders']);
		}
		elseif(@$_POST['smb'])
		{
			if (isset($_POST['smb']))
			{
				$pushed = $_POST['smb'];
				$pushOrder = $_SESSION['list_of_orders'];
				
				foreach ($pushed as $key => $value)
				{
					$ord = new Model_EquipOrder();
					$showOrd = $ord -> showEquipOrder($pushOrder[$key]['order_id']);
					
					$this -> title = "Детали заказа";
					
					$this->content = View::factory('order/detailOrder')
					->set("order", $showOrd[0]['order_id'])
					->set("status", $showOrd[1]['order_status'])
					->set("date", $showOrd[2]['delivery_date'])
					->set("period", $showOrd[3]['DeliveryPeriod'])
					->set("owner", $showOrd[4]['Buyer'])
					->set("build", $showOrd[5]['building'])
					->set("floor", $showOrd[6]['floor'])
					->set("office", $showOrd[7]['office'])
					->set("ex", $showOrd);
				}
			}
		}
		elseif (@$_POST['cancel'])
		{
			$this -> redirect('EquipOrder');
		}
		elseif (@$_POST['back'])
		{
			//Получаем список укомплектованных заказов на текущую дату
			$equip = new Model_EquipOrder();
			$eqOrd = $equip -> getEquipOrder();
			$_SESSION['list_of_orders'] = $eqOrd;
			
			$this -> title = "Укомплектованные заказы";
			
			$this->content = View::factory('order/showEquipOrder')
			->set("list", $_SESSION['list_of_orders']);
		}
		elseif(@$_POST['print'])
		{
			$getID = new Model_EquipOrder();
			$sendID = $getID -> immidiateOrder();
			
			//Устанавливаем статус "Укомплектован"
			$q = DB::query(Database::UPDATE, 'Update orders set order_status = "Укомплектован" where order_id = :id ')
			->param(':id', $sendID)
			->execute();
			
			$print = new Model_Report();
			$callWord = $print -> ExportWordOrder($sendID);		

			$this -> redirect('EquipOrder');
		}
	}
}