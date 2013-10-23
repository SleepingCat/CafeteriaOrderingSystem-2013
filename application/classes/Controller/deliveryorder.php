<?php defined('SYSPATH') or die('No direct script access.');
class Controller_deliveryorder  extends Controller_Checkinputusers
{
	public function action_index()
	{
		$this->content = View::factory('order/findorder')
		->set('title', "Поиск заказа");
	}
	
	public  function  action_ordersetstatus()
	{
		$session = Session::instance();
		if(isset($_POST['findButton']))
		{
			$OrderNumb = $_POST["orderNumber"];
			$register = new Model_Order();
			$CurrentState = $register->findOrder($OrderNumb);
			if ($CurrentState != "")
			{
				$_SESSION['orderForFind'] = $OrderNumb;
				$_SESSION['StatusOrderVeryOld'] = $CurrentState;
				$this->content = View::factory('order/setstatus')
				->set('title', "Установить статус")
				->set('OrderNumb',$OrderNumb)
				->set('CurrentState',$CurrentState);
			}
			else
			{
				$this->redirect("deliveryorder");
			}
		}
		else die('Bad request');
	}
	
	public  function  action_orderanswerstatus()
	{
		$session = Session::instance();
		$Statuses = new OrderStatus();
		$CurrNumb = $_SESSION['orderForFind'];
		$StateStatus1 = $_POST["ChosenStatus"];
		$OldStatus = $_SESSION['StatusOrderVeryOld'];
		if ($StateStatus1 == $OldStatus)
		{
			$this->redirect("deliveryorder");
		} 
		else 
		{
			$register = new Model_Order();
			if ($StateStatus1 == "Доставлен")
			{
				$Status = $StateStatus::Complectated;			
			} 		
			elseif ($StateStatus1 == "Не доставлен")
			{
				$Status = $StateStatus::NotComplectated;
			}
			else 
			{
				$this->redirect("deliveryorder");
			}
			//$this->title='Подтверждение';
			$this->content = View::factory('order/applySetStatus')
			->set('CurrNumb',$OrderNumb)
			->set('Status',$Status);
			if(isset($_POST['bOK']))
			{
			     $register ->setStatus($OrderNumb, $Status);
			}
		}		
	}

}