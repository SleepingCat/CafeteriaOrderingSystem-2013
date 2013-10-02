<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Order extends Controller {
	public function befroe()
	{
		$session = Session::instance();
		if (!isset($_SESSION['UserID']))
		{
			$_SESSION['UserID'] = MD5(microtime());
		}
	}
	
	public function action_index()
	{
		$session = Session::instance();
		if(isset($_POST['sbmt2']))
		{
			$_SESSION['date'] = $_POST['date'];
			$_SESSION['time'] = $_POST['time'];
			$_SESSION['place'] = $_POST['place'];
		}
		$this->response->body(View::factory('order/showorder')
			->set('title', "Ваш заказ")
			->set('order', $_SESSION['order'])
			->set('summ', $_SESSION['summ'])
			->set('d_date',$_SESSION['date'])
			->set('d_time',$_SESSION['time'])
			->set('place',$_SESSION['place']));
	}
	public function action_makeorder()
	{
		$session = Session::instance();
		if (isset($_POST['smbt']))
		{
			$summ = 0;
			// перепакуем данные
			foreach($_POST['order'] as $key => $value)
			{

				if(ctype_digit($value))
				{
					$order[$key] = $value;
					$summ = $summ + $_POST['order_price'][$key]*$value;
				}
			}
			//$savecart = new Model_Savecart();
			//$savecart->save($_SESSION['UserID'],$order);
			$_SESSION['order'] = $order;
			$_SESSION['summ'] = $summ;
			
			$this->response->body(View::factory('order/order')
				->set('title', "Подтвердите заказ")
				->set('order', $order)
				->set('summ', $summ)
				->set('menu_date', $_POST['menu_date'])
				);
		}
		else die('Bad request');
	}
	
	public function action_cancelorder()
	{
		$session = Session::instance();
		$_SESSION['order'] = null;
		$_SESSION['UserID'] = MD5(microtime());
		echo "Заказ отменен";
	}

	
} // End Welcome
