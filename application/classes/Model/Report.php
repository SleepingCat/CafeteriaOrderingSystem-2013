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
	
	/**
	 * Метод считывает количество заказов по заданным пунктам
	 * @param unknown $BeginDate - начало периода, с которого считываются заказы
	 * @param unknown $EndDate - окончание периода, с которого считываем
	 * @param string $State - состояния заказов
	 * @param string $PaymentType - платежный тип 1 или 0
	 * @param string $$NotState - состояния заказов которые не используются в отчетах
	 * @return Ambigous <mixed, unknown>
	 */
	public function  AddedInformationAboutOrders($BeginDate, $EndDate, $State = "", $PaymentType = "", $NotState = "")
	{
		$query = "Select Count(*) as CountOrder from orders where order_date <= '".$EndDate."' and ".
				" order_date >= '".$BeginDate."'";
		if ($State <> "")
			$query .= " and order_status in (".$State.")";
		if ($PaymentType != "")
			$query .= " and payment_type = ".$PaymentType;
		if ($NotState != "")
			$query .= " and order_status not in (".$NotState.")";
		$CountOrders = DB::query(Database::SELECT, $query)
		->execute()
		->get("CountOrder");
		return $CountOrders;
	}
	
	/**
	 * 
	 * Метод возвращает денежную сумму оплаченных заказов
	 * @param unknown $BeginDate - начало периода
	 * @param unknown $EndDate - конец периода 
	 * @param string $State - состояния 
	 * @param string $PaymentType - тип оплаты
	 * @param string $$NotState - состояния заказов которые не используются в отчетах
	 * @return Ambigous <mixed, unknown>
	 */
	public function AddedInformationAboutPay($BeginDate, $EndDate, $State = "", $PaymentType = "", $NotState = "")
	{
		$query = "Select Sum(total_price) as totalPrice from orders where order_date <= '".$EndDate."' and ".
				" order_date >= '".$BeginDate."'";
		if ($State != "")
			$query .= " and order_status in (".$State.")";
		if ($NotState != "")
			$query .= " and order_status not in (".$NotState.")";
		if ($PaymentType != "")
			$query .= " and payment_type = ".$PaymentType;
		$TotalPayment = DB::query(Database::SELECT, $query)
		->execute()
		->get("totalPrice");
		return $TotalPayment;
	}
	
	public  function  ReportAboutDishes($BeginDate, $EndDate)
	{
		$query = "select d1.dish_name, (select Count(*) ".
				" from orders o join ".
				" orders_records orec on o.order_id = orec.order_id join ".
				" dishes d on d.dish_id =  orec.menu_record_dish_id ".
				" where d.dish_id = d1.dish_id and o.order_date <= '".$EndDate."' and ".
				" o.order_date >= '".$BeginDate."') as CountDish ".
				" from dishes d1 where exists (select orec1.order_id from ".
				" orders_records orec1 join ".
				" orders o1 on o1.order_id = orec1.order_id ".
				" where orec1.menu_record_dish_id = d1.dish_id and o1.order_date <= '".$EndDate."' and ".
				" o1.order_date >= '".$BeginDate."')".
				" order by CountDish desc".
				" LIMIT 0 , 10";
		$Dishes = DB::query(Database::SELECT, $query)
		->execute()
		->as_array();
		return  $Dishes;
				
	}
	
	public function  ReportAboutDishesNotUsed($BeginDate, $EndDate)
	{
		$query = " select d1.dish_name ".
				" from dishes d1 where not exists(select orec1.order_id from ".
				" orders_records orec1 join ".
				" orders o1 on o1.order_id = orec1.order_id ".
				" where orec1.menu_record_dish_id = d1.dish_id and o1.order_date <= '".$EndDate."' and ".
				" o1.order_date >= '".$BeginDate."')";
		$Dishes = DB::query(Database::SELECT, $query)
		->execute()
		->as_array();
		return  $Dishes;
		
	}
	
	/**
	 * Метод выгружает отчет о клиентах
	 * @param unknown $BeginDate
	 * @param unknown $EndDate
	 */
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
	
	/**
	 * Метод выгружает отчет о заказах
	 * @param unknown $BeginDate
	 * @param unknown $EndDate
	 */
	public  function ExportWordOrders($BeginDate,$EndDate)
	{
		$odf = new Odtphp(APPPATH.'templates/orders.odt');
	
		$Date = 'c '.$BeginDate.' по '.$EndDate;
	
			
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
			
			$OrdCount = self::AddedInformationAboutOrders($BeginDate, $EndDate);
			$odf->setVars('col1', $OrdCount , $encode = TRUE, $charset='UTF-8');
			
			$OrdPay = self::AddedInformationAboutPay($BeginDate, $EndDate, "'".OrderStatus::Paymented."'");
			$odf->setVars('col2', $OrdPay , $encode = TRUE, $charset='UTF-8');
			
			$OrdCount1 = self::AddedInformationAboutOrders($BeginDate, $EndDate,"","1", "'".OrderStatus::Canceled."'");
			$odf->setVars('col3', $OrdCount1 , $encode = TRUE, $charset='UTF-8');
			
			$OrdCount2 = self::AddedInformationAboutOrders($BeginDate, $EndDate,"","0", "'".OrderStatus::Canceled."'");
			$odf->setVars('col4', $OrdCount2 , $encode = TRUE, $charset='UTF-8');
			
			$OrdCount3 = self::AddedInformationAboutOrders($BeginDate, $EndDate, "'".OrderStatus::Canceled."'");
			$odf->setVars('col5', $OrdCount3 , $encode = TRUE, $charset='UTF-8');
			
			$odf->setVars('date', $Date , $encode = TRUE, $charset='UTF-8');				
			
		// We export the file
		$odf->exportAsAttachedFile();
	
	}
	
	/**
	 * Метод выгружает отчет о блюдах
	 * @param unknown $BeginDate
	 * @param unknown $EndDate
	 */
	public  function ExportWordDishes($BeginDate,$EndDate)
	{
		$odf = new Odtphp(APPPATH.'templates/foods.odt');
		
		$Date = 'c '.$BeginDate.' по '.$EndDate;
		
		$odf->setVars('date', $Date , $encode = TRUE, $charset='UTF-8');
			
		$segment = 'articles';
			
		$kvit = $odf->setSegment($segment);
		$dishes = $this->ReportAboutDishes($BeginDate, $EndDate);
		
		foreach ($dishes as $item)
		{
			$kvit->setVars('username1', $item['dish_name'], true, 'utf-8');
			$kvit->setVars('numb1', $item['CountDish'], true, 'utf-8');
			$kvit->merge();
		}
		$odf->mergeSegment($kvit);
		
		$segment = 'articless';
			
		$kvit = $odf->setSegment($segment);
		$dishes = $this->ReportAboutDishesNotUsed($BeginDate, $EndDate);
		
		foreach ($dishes as $item)
		{
			$kvit->setVars('username2', $item['dish_name'], true, 'utf-8');
			$kvit->merge();
		}
		$odf->mergeSegment($kvit);
		
		// We export the file
		$odf->exportAsAttachedFile();
	}
	
	/**
	 * ОТчет для Илюхи
	 * @param Принимает ID_order(ID заказа)
	 * Выгружает отчет о заказе пользователя: номер заказа,адрес доставки,ФИО пол-ля,блюда их кол-во и стоимость
	 */
	public  function ExportWordOrder($ID)
	{	
		$odf = new Odtphp(APPPATH.'templates/complete.odt');		
		$segment = 'articles';				
		$kvit = $odf->setSegment($segment);							
		$ord = new Model_EquipOrder();
		$showOrd = $ord -> getDishes($ID);		
		$odf->setVars('numb_order', $ID, true, 'utf-8');
		$odf->setVars('surname', $showOrd[1]['Buyer'], true, 'utf-8');
		$odf->setVars('home', $showOrd[2]['building'], true, 'utf-8');
		$odf->setVars('floor', $showOrd[3]['floor'], true, 'utf-8');
		$odf->setVars('office', $showOrd[4]['office'], true, 'utf-8');
		
		foreach ($showOrd as $item)
			{
				$kvit->setVars('food', $item['dish_name'], true, 'utf-8');
				$kvit->setVars('price', $item['price'], true, 'utf-8');
				$kvit->setVars('count', $item['servings_number'], true, 'utf-8');		 
			    $kvit->merge();
			}
			
		$odf->mergeSegment($kvit);						 
		
			
		// We export the file
		$odf->exportAsAttachedFile();
	}
}