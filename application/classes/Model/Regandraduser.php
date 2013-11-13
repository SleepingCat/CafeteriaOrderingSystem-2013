
<?php defined('SYSPATH') or die('No direct script access.');

/**Модеель для добавления и редактировании данных пол-лей, а также профиля
 * 
 * @author Babur
 *
 */
class Model_Regandraduser  
 {
	/**
	 * Метод который выполняет добавление записей о пользователе !
	 * @return boolean
	 */
	public function reg()
	{	try
	
		 {	
		 	//Изменяем строки в полях: этаж,здание,номер кабинета,если пользователь вводит в роле больше двух пробелов 	 	
		 	$floor=preg_replace('/\s{2,}+/', ' ', Arr::get($_POST, 'floor'));	
		 	$building=preg_replace('/\s{2,}+/', ' ', Arr::get($_POST, 'building'));
		 	$office=preg_replace('/\s{2,}+/', ' ', Arr::get($_POST, 'office'));
		 	
		 	$user = ORM::factory('user', Arr::get($_POST, 'id'));
		 	//Записываем в поле таблицы: floor переменную $floor		 	
		 	$user->floor=$floor;
		 	//Записываем в поле таблицы: building переменную $building	
		 	$user->building=$building;
		 	//Записываем в поле таблицы: office переменную $office	
		 	$user->office=$office;

            // update user			
			$user->values($_POST, array('username','email', 'password','name','surname','patronymic','employee_number'))->save();
			
			//remove all roles
			$user->remove('roles');			
			
			// Устанавлием пол-лю статус 0(т.е false, что он не уволен)
			$user->user_status=0;		
			
			// Записываем статус в таблицу Users
			$user->save();			

			// Если пользователь нажал checkbox,то записывается значение(UserStatus=1) с чекбокса=1	(true,т.е что пол-й уволен)
			$user->values($_POST, array('user_status'))->save();
			
			// Вытаскиваем запись где роль='login'
			$rolelogins=ORM::factory('role')
			->where('name', '=', 'login')
			->find();
			// Записываем роль login для пользователя,чтобы он мог логинится как рядовой пользователь
			$user->add('roles', $rolelogins);		
					
			// Добавление новых ролей с нажатого чекбокса
			foreach (Arr::get($_POST, 'roles', array()) as $role)
			{				
				$user->add('roles', $role);				
			}
					
		    return true;	
           }		
		
			catch(ORM_Validation_Exception $e)
			{		
				return false;		
			}     		
 		}	
 	
 	public function reg_profile()
 	{		try
 		{
 			//Изменяем строки в полях: этаж,здание,номер кабинета,если пользователь вводит в роле больше двух пробелов
 			$floor=preg_replace('/\s{2,}+/', ' ', Arr::get($_POST, 'floor'));
 			$building=preg_replace('/\s{2,}+/', ' ', Arr::get($_POST, 'building'));
 			$office=preg_replace('/\s{2,}+/', ' ', Arr::get($_POST, 'office'));
 			
 			$user = ORM::factory('user', Arr::get($_POST, 'id'));
 			//Записываем в поле таблицы: floor переменную $floor
 			$user->floor=$floor;
 			//Записываем в поле таблицы: building переменную $building
 			$user->building=$building;
 			//Записываем в поле a: office переменную $office
 			$user->office=$office;
 			 	
 			// update user
 			$user->values($_POST, array('username','email','name','surname','patronymic','employee_number'))->save();
 			
 			return  true;
 		} 	
 		catch(ORM_Validation_Exception $e)
 		{
 			return false;
 		} 	
 	} 
 /**
  *  Вытаскиваем список ролей кроме роли login
  * @return роли 
  */
 public  function find_role()
 {
 	$roles=ORM::factory('role')
 	->where('name', '!=', 'login')
 	->order_by('name', 'ASC')->find_all(); 
 	return $roles;  
 }
 
 /**
  * Метод который выполняет SQL-запрос на смену статуса заказа в таблице orders
  */
 public  function changeorderstatus()
 {
 	$orderstatus=new OrderStatus(); 	
 
 	DB::query(Database::UPDATE, 'update orders set order_status=:status  where user_id=:ID and order_status=:ordstatus  ' )
 	->param(':status',$orderstatus::Canceled)
 	->param(':ordstatus',$orderstatus::NewOrder)
 	->param(':ID', Arr::get($_POST, 'id'))
 	->execute(); 	
 }
 
 /**
  * Метод который выполняет SQL-запрос на смену статуса подписки в таблице subscriptions
  */
 public  function changesubscriptionsstatus()
 {
 	DB::query(Database::UPDATE, 'update subscriptions set status=:status  where user_id=:ID ')
 	->param(':status', 'Подписка_отменена')
 	->param(':ID', Arr::get($_POST, 'id'))
 	->execute();
 }

 /**
  * Метод проверяет что бы флаг менялся не ранее 30 дней после последнего изменения
  * @param unknown $userID - ключевое поле пользователя
  * @return boolean
  */
 public  function chekDateChangeFlag($userID)
 {
    $NumOfDay = DB::query(Database::SELECT, 'SELECT DATEDIFF( NOW( ) , date_change ) as Razn from users u where u.id = :UID')
    ->param(':UID', $userID)
    ->execute()
    ->get('Razn');
    return $NumOfDay > 30;
 }
 
 public function  UpdateFlag()
 {
 	try {
 	    $user = ORM::factory('user', Arr::get($_POST, 'id'));
 	    //Проверяем изменился ли флаг удержание из зарплаты и если изменился проверяем прошло ли 30 дней
 	    $OldValue = (int) ($user->payment_type);
 	    if ($OldValue  <> (Arr::get($_POST, 'payment_type')))
     	{
 	    	if ($this->chekDateChangeFlag(Arr::get($_POST, 'id')))
 	     	{
 	    		// Записываем статус в таблицу Users
 	     		$user->payment_type = 0;
 	     		$user->save();
 	     		// Если пользователь нажал checkbox,то записывается значение(UserStatus=1) с чекбокса=1	(true,т.е что пол-й может оплачивать свои заказы из зарплаты)
 	     		$user->values($_POST, array("payment_type"))->save();
 		    	$user->date_change = date("d.m.y");
 		    	$user->save();
 			    return true;
 		    }
 		   else return false;
     	}
 	    return true;
 	}
 	catch(ORM_Validation_Exception $e)
 	{
 		return false;
 	}
 }
}