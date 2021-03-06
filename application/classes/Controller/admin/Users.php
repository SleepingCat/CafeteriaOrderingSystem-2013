<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Users extends Controller_Checkinputadmin 
{  	  /**
     * Список пол-й
     */ 
    public function action_index()
    {    	$Mes = "";
   			$Mes1="";
		if (!empty($_SESSION['Mes11']))
		{
			$Mes = $_SESSION['Mes11'];
			$Mes1 = $Mes;
			$_SESSION['Mes11'] = "";
		}
        // Запрашиваем список пол-й
        $users = ORM::factory('user')
            ->reset(FALSE);       
        
		// Создаем объект пагинации(страничная навигация)
       $pagination = Pagination::factory(array(
	        'group' => 'admin',
            'total_items' => $users->count_all(),
        ));      
        // Получаем список пол-й и количеств страниц пагинации
        $users = $users
        ->order_by('username', 'ASC')           
        ->offset($pagination->offset)
        ->limit($pagination->items_per_page)
        ->find_all();
        
        if ($this->request->post('back'))
        {
        
        	throw new HTTP_Exception_404('Вы не выбрали пользователя');
        
        }
       
        // Передаем в представление
       $this->content=View::factory('templates/admin/users/list', array(
            'items' => $users,
             'pagination'=>$pagination,
       		'search'=>View::factory('templates/admin/users/sereachview'),
       		'message'=> $Mes1,
            ));             
       //$this->styles = array('media/css/bootstrap.css' => 'screen');	  
       $this->title ="Список пользователей";     
    }
    
	/**
	 * Удаляем пол-й
	 */
	public function action_delete()
	{	
		// Get user id
		$user_id = $this->request->param('id');

		if (!$user_id)
		{
			throw new HTTP_Exception_404('Вы не выбрали пользователя');
		}
		// Get user
		$user = ORM::factory('user', $user_id);
		
		if (!$user->loaded())
		{
			throw new HTTP_Exception_404('Вы не выбрали пользователя');
		}		
	
		// Обращаемся к модели order, считываем USerID в таблице orders		
		$useridord= DB::query(Database::SELECT, 'SELECT user_id FROM orders   where user_id=:ID ') 		
 			->param(':ID', $user_id)
 			->execute()
			->get('user_id', 0);
		// Если UserId в таблице orders отсутсвует,то удаляем пол-ля
		if ($user_id != $useridord )
			{
				DB::query(Database::DELETE, 'Delete FROM roles_users   where user_id=:ID ') 		
				->param(':ID', $user_id)
				->execute(); 
				/*DB::query(Database::DELETE, 'Delete FROM users  where id=:ID ') 			
				->param(':ID', $user_id)
				->execute();*/		
				// Удаляем пол-ля			
				$user->delete();
				// Redirect admin/users	
				$_SESSION['Mes11'] = '<span style="color: green;">Пользователь был успешно удален</span>';
				$this->redirect('admin/users');
			}
				
			else 
			{				
				$_SESSION['Mes11'] = "<span>Пользователя нельзя удалить,т.к уже совершал заказ</span>";
				$this->redirect('admin/users');
			//throw new HTTP_Exception_404('Пользователя нельзя удалить,т.к уже совершал заказ');	
				
			}	
		}	
    /**
     * Создание нового пол-ля
     */
    public function action_new()
		{	
			// Объект модели Regandraduser
			 $register= new Model_Regandraduser();		 
			
			// Записываем в переменные значения с текстбоксов
			 $login=Arr::get($_POST,'username','');				  
	   		 $password=Arr::get($_POST,'password','');			 
		 	 $surname=Arr::get($_POST,'surname','');
			 $patronymic=Arr::get($_POST,'patronymic','');
			 $name=Arr::get($_POST,'name','');
		     $tab_numb=Arr::get($_POST,'employee_number','');		     	     
		     $email=Arr::get($_POST,'email','');
			 $floor=Arr::get($_POST,'floor','');
			 $building=Arr::get($_POST,'building','');
			 $office=Arr::get($_POST,'office','');
		     //$_SESSION['email'] =  $email;     
		     
		     
		     // правила валидации вызываем
		$post = Validation::factory($_POST)			
			->rule('username', 'not_empty')
			->rule('username', 'Model_Valid::user_unique',array(':value',''))
			->rule('username', 'alpha_dash')
			->rule('username', 'min_length', array(':value', 6))
			->rule('username', 'max_length', array(':value', 16))
			->rule('surname', 'not_empty')
			->rule('surname', 'Model_Valid::valid',array(':value'))
			->rule('name', 'not_empty')
			->rule('name', 'Model_Valid::valid',array(':value'))
			->rule('patronymic', 'not_empty')
			->rule('patronymic', 'Model_Valid::valid',array(':value'))
			->rule('building', 'Model_Valid::valid_string',array(':value'))
			->rule('floor', 'Model_Valid::valid_string',array(':value'))
			->rule('office', 'Model_Valid::valid_string',array(':value'))
			//->rule('building', 'not_empty')
			//->rule('floors', 'not_empty')
			//->rule('num_office', 'not_empty')
			->rule('employee_number', 'not_empty')
			->rule('employee_number', 'Model_Valid::tab_number',array(':value',''))	
			->rule('email', 'not_empty')          
			->rule('email', 'email')
			->rule('email', 'Model_Valid::email_unique',array($email,''))
			->rule('employee_number', 'not_empty')		
			->rule('employee_number', 'max_length', array(':value', 6))
			->rule('employee_number', 'Model_Valid::tab_number',array(':value',$tab_numb))
			->rule('employee_number', 'Model_Valid::tab_number_unique',array(':value',''))
			->rule('password', 'not_empty');
		
		if (!empty($post['password']))
		{	$post			
			->rule('password', 'Model_Valid::login_valid',array($login ,$password))			
			->rule('password', 'min_length', array(':value', 6))
			->rule('password', 'max_length', array(':value', 16))
			->rule('password', 'Model_Valid::preg_match')
			->rule('password_confirm', 'not_empty')
			->rule('password_confirm', 'matches', array(':validation', 'password', 'password_confirm'));			
		}

		// Пользователей нажал кнопку submit
 		 if (isset($_POST['subm']))
       	{
		// ЗАпускаем ручнуб вадлидацию
		if ($post->check())
		  {		//Добавляем пол-ля,если все OK , то переходим на контролл admin/users
		  		if($register->reg())
				{			
					$_SESSION['Mes11'] = '<span style="color: green;">Пользователь был успешно создан</span>';
		      		 $this->redirect('/admin/users');	    
				}
		  }
	    }	    
	    // Кнопка назад
	    if ($this->request->post('back'))
	    {
	    	$this->redirect('/admin/users');
	    }	    
	   		 // Список ошибок валидации, хранится в файле messages/validation.php
			View::set_global('errors', $post->errors('validation'));    
			    
			// Получаем список ролей
			$roles = $register->find_role(); 
		 	
			$this->content=View::factory('templates/admin/users/add_form')
				->set(array(
				'item' => array_merge( array('roles' => array())),
				'roles' => $roles,
				'email'=>$email,
				'employee_number'=>$tab_numb,
				'login'=> $login,
				'surname'=> $surname,
				'name'=> $name,
				'patronymic'=>$patronymic,
				'building'=>$building,
				'office'=>$office,
				'floor'=>$floor,
				));					
			//$this->styles = array('media/css/style.css' => 'screen');
			$this->title ="Новый пользователь";
   		}
    /**
     * Редактирование пользователя
     *
     * @throws HTTP_Exception_404
     */
    public function action_edit()
	{	// Объект модели Regandraduser
		$register = new Model_Regandraduser();	
		$error=Array();
		// Получаем id пол-ля
		$user_id = $this->request->param('id');
		
		// Если id не удоось получить ,то ошибка
		if (!$user_id)
		{
			throw new HTTP_Exception_404('Вы не выбрали пользователя');
		}
		
		// Получаем пользователя по id
		$user = ORM::factory('user', $user_id);
		
		// Если не нажали на кнопку редактирвоание ,то ошибка
		if (!$user->loaded())
		{
			throw new HTTP_Exception_404('Вы не выбрали пользователя');
		}
		
		// Получаем роли пол-лей
		$item['roles'] = array();
		
		foreach ($user->roles->find_all() as $role)
		{
			$item['roles'][] = $role->id;
		}   
		
		// ПОлучаем список ролей
		$roles = $register->find_role();	
		
		// Set content template
		$this->content=View::factory('templates/admin/users/form')
		->set(array(
			'item' => array_merge($user->as_array(), $item),
			'roles' => $roles,
			'errors' => $error,		
		));
			//->set('errors',$error);		
		$this->title ="Редактирование пользователя";									
	}	
	
    /**
     * Сохранение отредактирвоанных значений полей, все почти аналогично экшену создания пол-ля
     *
     * @throws HTTP_Exception_404
     */
    public function action_save()
	{	
	    $register = new Model_Regandraduser();	
		$val = new Model_Valid();	
	   
	    // Protect page
		if ($this->request->method() !== Request::POST)
		{
			throw new HTTP_Exception_404('Page not found.');
		}        
       
	    $login=Arr::get($_POST,'username','');		
		$log_old=Arr::get($_POST,'username_old','');		
		$tab_numb=Arr::get($_POST,'employee_number','');		
		$password=Arr::get($_POST,'password','');	
		$building=	Arr::get($_POST,'building','');	
		$email_old=Arr::get($_POST,'email_old','');
		$email=Arr::get($_POST,'email','');
		$tab_numb_old=Arr::get($_POST,'employee_number_old','');		

		$post = Validation::factory($_POST)		
			->rule('username', 'not_empty')
			->rule('username', 'Model_Valid::user_unique',array(':value', $log_old))
			->rule('username', 'alpha_dash')
			->rule('username', 'min_length', array(':value', 6))
			->rule('username', 'max_length', array(':value', 16))
			->rule('surname', 'not_empty')
			->rule('surname', 'Model_Valid::valid',array(':value'))		
			->rule('name', 'not_empty')
			->rule('name', 'Model_Valid::valid',array(':value'))
			->rule('patronymic', 'not_empty')
			->rule('patronymic', 'Model_Valid::valid',array(':value'))
			->rule('building', 'Model_Valid::valid_string',array(':value'))
			->rule('floor', 'Model_Valid::valid_string',array(':value'))
			->rule('office', 'Model_Valid::valid_string',array(':value'))
			//->rule('building', 'not_empty')
			//->rule('floors', 'not_empty')
			//->rule('num_office', 'not_empty')
			->rule('employee_number', 'not_empty')
			->rule('employee_number', 'Model_Valid::tab_number',array(':value',$tab_numb))	
			->rule('email', 'not_empty')          
			->rule('email', 'email')
			->rule('email', 'Model_Valid::email_unique',array($email,	$email_old))
			->rule('employee_number', 'not_empty')		
			->rule('employee_number', 'max_length', array(':value', 6))
			->rule('employee_number', 'Model_Valid::tab_number',array(':value'))
			->rule('employee_number', 'Model_Valid::tab_number_unique',array(':value',$tab_numb_old));
			//->rule('password', 'not_empty');
			
		if (!empty($post['password']) OR (!empty($post['password_confirm'])))			
		{				
			$post		
			->rule('password', 'Model_Valid::login_valid',array($login ,$password))			
			->rule('password', 'min_length', array(':value', 6))
			->rule('password', 'max_length', array(':value', 16))
			->rule('password', 'not_empty')
			->rule('password', 'Model_Valid::preg_match')
			->rule('password_confirm', 'not_empty')
			->rule('password_confirm', 'matches', array(':validation', 'password', 'password_confirm'));			
			}
						
			// remove password if empty
            if (empty($_POST['password']))
            {
                unset($_POST['password']);
            }

            // Функция для кнопки назад на вьюшке
            if ($this->request->post('back'))
            {
            	$this->redirect('/admin/users');
            }
				
		if ($post->check())
		{
			if($register->reg($login))			
			{ 				
				//Считываем статус пол-ля
			   $usertemp= ORM::factory('user',array('username'=> $login));
			   $user=$usertemp->user_status;			  
				
				// Если статус пол-ля уволен,то вызываем метод который выполняет SQL-запрос на смену статуса в таблице orders
				 if ($user == 1)			   
			   { 	
			   		$register->changeorderstatus();
			   		$register->changesubscriptionsstatus();		
			   		$_SESSION['Mes11'] = '<span style="color: green;">Пользователь был уволен и все его дейтсвующие заказы отеменены</span>';
			   		$this->redirect('/admin/users');
			   }
			   
			   else			   
			   {	
			   	$_SESSION['Mes11'] = '<span style="color: green;">Пользователь был успешно отредактирован</span>';
			   	$this->redirect('/admin/users');			   
			   }			 
			}	
		}			
		
		// Список ошибок валидации, хранится в файле messages/validation.php
        View::set_global('errors', $post->errors('validation'));
        		
		$roles = $register->find_role();			
		$this->content= View::factory('templates/admin/users/form')
		->set(array(
				'item' => $post->data(),
				'roles' => $roles,
			)
		);	  	
		//$this->styles = array('media/css/style.css' => 'screen');	
}
	
	public function action_search()	
	{	
		// Записываем значения таб-го номера
		$tab_numb=Arr::get($_POST,'search','');
		
		// Запрашиваем пол-й
		$users = ORM::factory('user')		
		->where('employee_number', "LIKE ", '%'. $tab_numb .'%')
		->or_where('surname', "LIKE ", '%'. $tab_numb .'%')
		->or_where('name', "LIKE ", '%'. $tab_numb .'%')
		->or_where('patronymic', "LIKE ", '%'. $tab_numb .'%')
		->reset(FALSE);
			
		// Создаем объект пагинациии
		$pagination = Pagination::factory(array(
				'group' => 'admin',
				'total_items' => $users->count_all(),
		));
	
		// Получаем список пол-й
		$users = $users
		->order_by('username', 'ASC')
		->offset($pagination->offset)
		->limit($pagination->items_per_page)
		->find_all();	
		
		$this->content=View::factory('templates/admin/users/list', array(
				'items' => $users,
				'pagination'=>$pagination,
				'search'=>View::factory('templates/admin/users/sereachview'),
				'message'=> '',
		));	
		
		//$this->styles = array('media/css/bootstrap.css' => 'screen');
		$this->title ="Список пользователей";		
	}	
	
	
	public function action_reports()
	{	
		/*require_once('D:\\library/odf.php');
		$odf = new odf("D:\\1.odt");*/		
		$odf = new Odtphp(APPPATH.'templates/users.odt');
		
	//	$odf->setVars('privet', 'Иван', $encode = TRUE, $charset='UTF-8');		
		//$users = ORM::factory('user');
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
			$kvit->setVars('building', $item['building'], true, 'utf-8');
			$kvit->setVars('floor', $item['floor'], true, 'utf-8');
			$kvit->setVars('office', $item['office'], true, 'utf-8');
			$kvit->setVars('numb', $item['office'], true, 'utf-8');
			$kvit->merge();
		}
		
		$odf->mergeSegment($kvit);
		
		// We export the file
		$odf->exportAsAttachedFile();		
	}
		
} // End Admin Users
