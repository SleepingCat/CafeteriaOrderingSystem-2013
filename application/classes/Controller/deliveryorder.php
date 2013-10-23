<?php defined('SYSPATH') or die('No direct script access.');
class Controller_deliveryorder  extends Controller_Checkinputusers
{
	public function before()
	{
		Session::instance();
		parent::before();
	}
	
	public function action_index()
	{
		$this->title = "Поиск заказа";
		$this->content = View::factory('order/findorder');
	}
	
	public  function  action_ordersetstatus()
	{	
		if(isset($_POST["findButton"]))
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
		$Statuses = new OrderStatus();
		$CurrNumb = $_SESSION['orderForFind'];
		$StateStatus1 = $_POST["ChosenStatus"];
		$OldStatus = $_SESSION['StatusOrderVeryOld'];
		if ($StateStatus1 == $OldStatus)
		{
			$this->redirect("http://".$_SERVER['HTTP_HOST']."/deliveryorder");
		} 
		else 
		{
			//TODO: Переделать с перечислениями состояний пока некогда
			if ($StateStatus1 == "Доставлен")
			{
				$Status = "Доставлен";
				//$StateStatus::Complectated;			
			} 		
			elseif ($StateStatus1 == "Не доставлен")
			{
				$Status = "Не доставлен";
				//$StateStatus::NotComplectated;
			}
			else 
			{
				$this->redirect("http://".$_SERVER['HTTP_HOST']."/deliveryorder");
			}
			//$this->title='Подтверждение';
			$_SESSION['StatusOrderVeryNew'] = $Status;
			$this->content = View::factory('order/applySetStatus')
			->set('CurrNumb',$CurrNumb)
			->set('Status',$Status);
		}	
	}
	
	public  function action_ordersetnewstatus()
	{
		if(isset($_POST['bOK']))
		{
			$CurrNumb = $_SESSION['orderForFind'];
			$Status = $_SESSION['StatusOrderVeryNew'];
			$register = new Model_Order();
			$register->setStatus($CurrNumb, $Status);
		}
		$this->redirect("http://".$_SERVER['HTTP_HOST']."/deliveryorder");
	}
}