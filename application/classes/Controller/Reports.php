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
		$date1 = Arr::get($_POST,'Start','');
		$date2 = Arr::get($_POST,'End','');
		
		$ts1 = strtotime($date1);
		$ts2 = strtotime($date2);
		
		
		if ($ts1 > $ts2 OR empty($date1))		
		{			
			
		$error = 'Вы не ввели дату или выбрали некорретный период';
				
		}
		
		else 
		{
			
		if ($Mes2 == "Клиенты")			
		{			
			/*require_once('D:\\library/odf.php');
			$odf = new odf("D:\\1.odt");*/
			$odf = new Odtphp(APPPATH.'templates/users1.odt');
			
			$odf->setVars('privet', 'Иван', $encode = TRUE, $charset='UTF-8');
			$users = ORM::factory('user');
			$users =  DB::query(Database::SELECT,
			"select * from users")
			->execute()
			->as_array();
			//->find_all();
			$kvit = $odf->setSegment('articles');
			
			foreach ($users as $item){
			$kvit->setVars('username', $item['username'], true, 'utf-8');
			$kvit->setVars('email', $item['email'], true, 'utf-8');
			$kvit->setVars('surname', $item['surname'], true, 'utf-8');
			$kvit->setVars('name', $item['name'], true, 'utf-8');
			$kvit->setVars('patronymic', $item['patronymic'], true, 'utf-8');
		
			$kvit->setVars('numb', $item['employee_number'], true, 'utf-8');
			$kvit->merge();
			}			
			$odf->mergeSegment($kvit);
			
			// We export the file
			$odf->exportAsAttachedFile();			
		}
	}	
}		
		$this->styles = array('media/css/style.css' => 'screen');
		$this->scripts = Arr::merge(array(Route::get('media')->uri(array('file' => 'js/jquery.ui.datepicker-ru.min.js'))), $this->scripts);
		$this->content = View::factory('templates/reports/date', array(				
	    'Rep'=>$Mess,
		'error'=>$error,
		
		));
		
			
	}
	
	
}