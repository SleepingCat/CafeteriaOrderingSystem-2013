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
		$Mes = "";
		if (!empty($_SESSION['Mes']))
		{
		   $Mes = $_SESSION['Mes']; 
		   $_SESSION['Mes'] = "";
		}
		$this->message = $Mes; 
		$this->title = "Поиск заказа";
		$this->content = View::factory('order/findorder');
	}
	
	public  function  action_ordersetstatus()
	{	
		if(isset($_POST["findButton"]))
		{
			$OrderNumb = $_POST["orderNumber"];
			$States = new OrderStatus();
			$register = new Model_Order();
			$Constr = "'".$States::Complected."','".$States::Delivered."','".$States::NotDelivered."'";
			$CurrentState = $register->findOrder($OrderNumb,$Constr);
			if ($CurrentState != "")
			{
				$_SESSION['orderForFind'] = $OrderNumb;
				$_SESSION['StatusOrderVeryOld'] = $CurrentState;
				$this->title = "Установить статус";
				$this->content = View::factory('order/setstatus')
				->set('OrderNumb',$OrderNumb)
				->set('CurrentState',$CurrentState)
				->set('States' , $States);	
			}
			else
			{
				$_SESSION['Mes'] = "Заказ не найден";
				$this->title = "Поиск заказа";
				$this->redirect("https://".$_SERVER['HTTP_HOST']."/deliveryorder");
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
			$_SESSION['Mes'] = "Состояние заказа не изменено.";
			$this->redirect("https://".$_SERVER['HTTP_HOST']."/deliveryorder");
		} 
		else 
		{
			$Status = $StateStatus1;
			$_SESSION['StatusOrderVeryNew'] = $Status;
			$this->title='Подтверждение';
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
		$_SESSION['Mes'] = "Состояние успешно изменено.";
		$this->redirect("https://".$_SERVER['HTTP_HOST']."/deliveryorder");
	}
}