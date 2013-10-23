<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Userprofile extends Controller_Checkinputusers
{ 

public function action_index()	
	{				
		$id=$this->user['id'];				
		$users = ORM::factory('user')
			->where('id', '=', $id);		
		
		// Получаем список пол-й и количеств страниц пагинации
		$users= $users				
		->find();
				
		// Передаем в представление
		$this->content=View::factory('templates/admin/users/regview', array(
				'item' =>array_merge($users->as_array()),				
		))
		->set('errors','');
		 
		 $this->title = 'Профиль клиента';	
		$this->styles = array('media/css/bootstrap.css' => 'screen');		
		
	}
	
	public function action_saveprofile()
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
		
		$password_old=Arr::get($_POST,'password_old','');
		
		$email=Arr::get($_POST,'email','');
		$email_old=Arr::get($_POST,'email_old','');	
		$tab_numb_old=Arr::get($_POST,'employee_number_old','');
						
		$user = Auth::instance()->get_user()->as_array();
		$pass=$user['password'];		
		
		$hashpas=$pass;		
		$auth=Auth::instance();
		$hasholdpas=$auth->hash_password($password_old);
		
	
		$post = Validation::factory($_POST)
		->rule('username', 'not_empty')
		->rule('username', 'Model_Valid::user_unique',array(':value', $log_old))
		->rule('username', 'alpha_dash')
		->rule('username', 'min_length', array(':value', 6))
		->rule('username', 'max_length', array(':value', 16))
		->rule('surname', 'not_empty')
		->rule('name', 'not_empty')
		->rule('patronymic', 'not_empty')
		//->rule('building', 'not_empty')
		//->rule('floors', 'not_empty')
		//->rule('num_office', 'not_empty')
		->rule('employee_number', 'not_empty')
		->rule('employee_number', 'Model_Valid::tab_number',array(':value',$tab_numb))
		->rule('email', 'not_empty')
		->rule('email', 'email')
		->rule('email', 'Model_Valid::email_unique',array(':value',	$email_old))
		->rule('employee_number', 'not_empty')
		->rule('employee_number', 'max_length', array(':value', 6))
		->rule('employee_number', 'Model_Valid::tab_number',array(':value'))
		->rule('employee_number', 'Model_Valid::tab_number_unique',array(':value',$tab_numb_old));
			
		if (!empty($post['password']))
		{
			$post
			->rule('password', 'Model_Valid::login_valid',array($login ,$password))
			->rule('password', 'min_length', array(':value', 6))
			->rule('password', 'max_length', array(':value', 16))
			->rule('password', 'Model_Valid::preg_match')
			->rule('password_old', 'Model_Valid::check_password',array($hashpas,$hasholdpas));
			
		//	->rule('password_confirm', 'not_empty')
			//->rule('password_confirm', 'matches', array(':validation', 'password', 'password_confirm'));
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
			if($register->reg_profile())
			{				
				$this->redirect('');				
			}
		}
	
		// Список ошибок валидации, хранится в файле messages/validation.php
		View::set_global('errors', $post->errors('validation'));
	
		$roles = $register->find_role();
		$this->content= View::factory('templates/admin/users/regview')
		->set(array(
				'item' => $post->data(),		
		)
		);
		//$this->styles = array('media/css/style.css' => 'screen');
	}
}