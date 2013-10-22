
<?php defined('SYSPATH') or die('No direct script access.');

class Model_Regandraduser  
 {
	/**
	 * Метод который выполняет добавление записей о пользователе !
	 * @return boolean
	 */
	public function reg()
	{		try
		 {     
			$user = ORM::factory('user', Arr::get($_POST, 'id'));			

            // update user			
			$user->values($_POST, array('username','email', 'password','name','surname','patronymic','building','floors','num_office','employee_number'))->save();
			
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
 			$user = ORM::factory('user', Arr::get($_POST, 'id')); 	
 			// update user
 			$user->values($_POST, array('username','email', 'password','payment_type','name','surname','patronymic','building','floors','num_office','employee_number'))->save();
 		 		return true;
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
 	DB::query(Database::UPDATE, 'update Orders set order_status=:status  where user_id=:ID ')
 	->param(':status', 'Заказ_отменен')
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
			 
}