<?php defined('SYSPATH') or die('No direct script access.');
//
//@autor = MrAnderson;
//
//
class Controller_Reports extends Controller_Checkinputusers
{	
	public function action_index()
	{
		$Mess = "";
		$Mess1 = "";
		$Mess2="";
		
		 if (isset($_POST['subm']))
		{
			$_SESSION['Mes'] = 'Отчет по клиентам';
			$_SESSION['Mes1'] = 'Клиенты';
			$this->redirect('/Reports/printreports');					
		}		

		if (isset($_POST['food']))
		{
			$_SESSION['Mes'] = 'Отчет по блюдам';
			$_SESSION['Mes1'] = 'Блюда';
			$this->redirect('/Reports/printreports');
		}
		
		if (isset($_POST['order']))
		{
			$_SESSION['Mes'] = 'Отчет по заказам';
			$_SESSION['Mes1'] = 'Заказы';
			$this->redirect('/Reports/printreports');
		}
		$this->title="Отчеты";
		$this->content = View::factory('templates/reports/repview');	
		$this->styles = array('media/css/style.css' => 'screen');
		
	}
	
	public function action_printreports()	
	{	
		$Mess = "";
		$error="";
		
		if (!empty($_SESSION['Mes']))
		{
			$Mes = $_SESSION['Mes'];
			$Mess = $Mes;						
			$Mes2 =  $_SESSION['Mes1'];			
		}		
		
		if (isset($_POST['subm']))
		{
			$BeginDate = Arr::get($_POST,'Start','');
			$EndDate = Arr::get($_POST,'End','');			
			$ts1 = strtotime($BeginDate);
			$ts2 = strtotime($EndDate);			
			
			if ($ts1 > $ts2 OR empty($BeginDate))		
			{
				$error = 'Вы не ввели дату или выбрали некорректный период';					
			}		
		else 
			{			
				if ($Mes2 == "Клиенты")			
				{
					$RepVal = new Model_Report();					
					$RepVal ->ExportWordClients($BeginDate, $EndDate);
				}	
				
				if ($Mes2 == "Заказы")		
				{					
					$RepVal = new Model_Report();
					$RepVal ->ExportWordOrders($BeginDate, $EndDate);					
				}	
			}
		}	
		$this->title =$Mess; 			
		$this->styles = array('media/css/style.css' => 'screen');
		$this->scripts = Arr::merge(array(Route::get('media')->uri(array('file' => 'js/jquery.ui.datepicker-ru.min.js'))), $this->scripts);
		$this->content = View::factory('templates/reports/date', array(				
	    'Rep'=>$Mess,
		'error'=>$error,
		
		));			
	}
}
	

	
	
