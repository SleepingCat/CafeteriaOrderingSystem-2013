<?php defined('SYSPATH') or die('No direct script access.');

/**Модель для запросов, которые используються в отчетах системы
 *
* @author Babur Соколов
*
*/
class Model_Report
{
	/**
	 * 
	 * @param unknown $BeginDate дата начала отчета
	 * @param unknown $EndDate дата окончания отчета
	 * @param unknown $IsUseSystem - если принимает значение true возвращается всех пользователей, которые пользуются системой
	 * иначе тех кто не пользуется системой. 
	 * @return Ambigous <multitype:, multitype:unknown NULL >
	 */
	public function ReportAboutUser($BeginDate, $EndDate, $IsUseSystem)
	{
		$query = "select username,surname, name, patronymic, email, employee_number from users U ".
				"where "; 
		if (!$IsUseSystem) 
		{
			$query .= " not ";
		}
		$query .= "exists(select O.order_id from orders O where O.user_id = U.id and O.order_date >= '".$BeginDate."' ".
				" and O.order_date <='".$EndDate."')";
		$Users = DB::query(Database::SELECT, $query) 
		->execute()
		->as_array();
		return $Users;
	} 
	
	/**
	 * Метод возвращает SUM - среднее количество заказов на период
	 * delivery_time - интервал времени
	 * @param unknown $BeginDate - начлао периода
	 * @param unknown $EndDate - окончания периода
	 * @return Ambigous <multitype:, multitype:unknown NULL >
	 */
	public function ReportAboutOrders($BeginDate, $EndDate)
	{
		$query = "SELECT dt.delivery_time, (select  ".
				"count(dt2.delivery_id)/DATEDIFF('".$EndDate."','".$BeginDate."') from  ".
				"delivery_times dt2 join ".
				"orders o ON dt2.delivery_id = o.delivery_times_delivery_id ".
				"where  o.order_date <='".$EndDate."' and ".
				"o.order_date >= '".$BeginDate."' ".
				"and dt.delivery_id = dt2.delivery_id) as Sum ".
				"FROM delivery_times dt ";
		$Times = DB::query(Database::SELECT, $query)
		->execute()
		->as_array();
		return $Times;
	}
	
	public  function ExportWordClients($BeginDate,$EndDate)
	{		
		$odf = new Odtphp(APPPATH.'templates/users.odt');			
		
		$Date = 'c '.$BeginDate.' по '.$EndDate;
		$odf->setVars('date', $Date , $encode = TRUE, $charset='UTF-8');
			
		for ($i=1; $i <3; $i++)
		{
			$isUsedSystem = $i==1;
			$segment = 'articles';
			if ($i == 2)
				$segment.='s';
			    $kvit = $odf->setSegment($segment);
				$users = $this->ReportAboutUser($BeginDate, $EndDate, $isUsedSystem);
							
				foreach ($users as $item)
				{
				    $kvit->setVars('username'.(string)$i, $item['username'], true, 'utf-8');
					$kvit->setVars('email'.(string)$i, $item['email'], true, 'utf-8');
					$kvit->setVars('surname'.(string)$i, $item['surname'], true, 'utf-8');
				    $kvit->setVars('name'.(string)$i, $item['name'], true, 'utf-8');
					$kvit->setVars('patronymic'.(string)$i, $item['patronymic'], true, 'utf-8');		
					$kvit->setVars('numb'.(string)$i, $item['employee_number'], true, 'utf-8');
					$kvit->merge();
				}
				$odf->mergeSegment($kvit);
		    	$odf->setVars('privet'.(string)$i, count($users) , $encode = TRUE, $charset='UTF-8');
		}
			
		// We export the file
		$odf->exportAsAttachedFile();		
	}
	
	public  function ExportWordOrders($BeginDate,$EndDate)
	{
		$odf = new Odtphp(APPPATH.'templates/orders.odt');
	
		$Date = 'c '.$BeginDate.' по '.$EndDate;
		$odf->setVars('date', $Date , $encode = TRUE, $charset='UTF-8');			
		
	
		$segment = 'articles';
			
		$kvit = $odf->setSegment($segment);
	    $orders = $this->ReportAboutOrders($BeginDate, $EndDate);
								
		foreach ($orders as $item)
		{
			$kvit->setVars('username1', $item['delivery_time'], true, 'utf-8');
			$kvit->setVars('numb1', $item['Sum'], true, 'utf-8');			
			$kvit->merge();					
		}
			$odf->mergeSegment($kvit);
			//$odf->setVars('privet'.(string)$i, count($users) , $encode = TRUE, $charset='UTF-8');
			
		// We export the file
		$odf->exportAsAttachedFile();
	
	}
}