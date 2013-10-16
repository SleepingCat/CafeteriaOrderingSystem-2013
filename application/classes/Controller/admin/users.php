<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Users extends Controller_Checkinputadmin 
{  	  /**
     * Users List Action
     */   
    public function action_index()
    {	   
        // Load users list query
        $users = ORM::factory('user')
            ->reset(FALSE);		
		// Create pagination object
       $pagination = Pagination::factory(array(
	        'group' => 'admin',
            'total_items' => $users->count_all(),
        ));
        // Modify users list query
        $users = $users
        ->order_by('username', 'ASC')           
        ->offset($pagination->offset)
        ->limit($pagination->items_per_page)
        ->find_all();				
        // Set content template
       $this->content=View::factory('templates/admin/users/list', array(
            'items' => $users,
             'pagination'=>$pagination,
       		'search'=>View::factory('templates/admin/users/sereachview'),
        ));      
       $this->styles = array('media/css/bootstrap.css' => 'screen');	  
       $this->title ="Список пользователей";
    }
	/**
	 * Delete user action
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
		
		
		$useridord= ORM::factory('order',array('USerId'=> $user_id));
		
		$useridorder=$useridord->UserId=1;
		
		$this->title=$useridorder;
		
		if ($user_id != $useridorder )
		{	
		// Delete user
		$user->delete();
		// Redirect to base page
		 $this->redirect('admin/users');
		}
		
		else 
		{			
			throw new HTTP_Exception_404('Пользователя нельзя удалить,т.к совершил заказ');
			
		}		
	}
    /**
     * Create user action
     */
    public function action_new()
	{		// Back
			if ($this->request->post('back'))
			{			
				$this->redirect('/admin');
			}
								
			 $register= new Model_Regandraduser();		 
			 $login=Arr::get($_POST,'username','');				  
	   		 $password=Arr::get($_POST,'password','');			 
		 	 $surname=Arr::get($_POST,'surname','');
		     $tab_numb=Arr::get($_POST,'personnel_number','');		     	     
		     $email=Arr::get($_POST,'email','');
	
		$post = Validation::factory($_POST)			
			->rule('username', 'not_empty')
			->rule('username', 'Model_Valid::user_unique',array(':value',''))
			->rule('username', 'alpha_dash')
			->rule('username', 'min_length', array(':value', 6))
			->rule('username', 'max_length', array(':value', 16))
			->rule('surname', 'not_empty')
			->rule('name', 'not_empty')
			->rule('patronymic', 'not_empty')
			//->rule('building', 'not_empty')
			//->rule('floors', 'not_empty')
			//->rule('num_office', 'not_empty')
			->rule('personnel_number', 'not_empty')
			->rule('personnel_number', 'Model_Valid::tab_number',array(':value',''))	
			->rule('email', 'not_empty')          
			->rule('email', 'email')
			->rule('email', 'Model_Valid::email_unique',array($email,''))
			->rule('personnel_number', 'not_empty')		
			->rule('personnel_number', 'Model_Valid::tab_number',array(':value',$tab_numb))
			->rule('personnel_number', 'Model_Valid::tab_number_unique',array(':value',''));			
		
		if (!empty($post['password']))
		{	$post			
			->rule('password', 'Model_Valid::login_valid',array($login ,$password))			
			->rule('password', 'min_length', array(':value', 6))
			->rule('password', 'max_length', array(':value', 16))
			->rule('password', 'Model_Valid::preg_match')
			->rule('password_confirm', 'not_empty')
			->rule('password_confirm', 'matches', array(':validation', 'password', 'password_confirm'));			
		}
					
 		 if (isset($_POST['subm']))
       	{
		// check validation
		if ($post->check())
		  {			
		  			if($register->reg())
				{			
		      		 $this->redirect('/admin/users');	    
				}
		  }
	    }	
			View::set_global('errors', $post->errors('validation'));        
			$roles = $register->find_role(); 
			$this->content=View::factory('templates/admin/users/add_form')
				->set(array(
				'item' => array_merge( array('roles' => array())),
				'roles' => $roles,
				));					
			$this->styles = array('media/css/style.css' => 'screen');
			$this->template->title ="Новый пользователь";
   }
    /**
     * Edit user action
     *
     * @throws HTTP_Exception_404
     */
    public function action_edit()
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
		
		// User roles
		$item['roles'] = array();
		foreach ($user->roles->find_all() as $role)
		{
			$item['roles'][] = $role->id;
		}	    
		
		// Roles list
		$roles = ORM::factory('role')->order_by('name', 'ASC')->find_all();
		// Set content template
		$this->content=View::factory('templates/admin/users/form')
		->set(array(
			'item' => array_merge($user->as_array(), $item),
			'roles' => $roles,
		))
		->set('errors','');
		
		$this->styles = array('media/css/style.css' => 'screen');
		$this->title ="Редактирование пользователя";									
	}	
    /**
     * Save user action
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
        // Back
        if ($this->request->post('back'))
        {
           $this->redirect('/admin/users');
        }
       
	    $login=Arr::get($_POST,'username','');		
		$log_old=Arr::get($_POST,'username_old','');		
		$tab_numb=Arr::get($_POST,'personnel_number','');		
		$password=Arr::get($_POST,'password','');		
		$email_old=Arr::get($_POST,'email_old','');
		$email=Arr::get($_POST,'email','');
		$tab_numb_old=Arr::get($_POST,'personnel_number_old','');		
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
			->rule('personnel_number', 'not_empty')
			->rule('personnel_number', 'Model_Valid::tab_number',array(':value',$tab_numb))	
			->rule('email', 'not_empty')          
			->rule('email', 'email')
			->rule('email', 'Model_Valid::email_unique',array($email,	$email_old))
			->rule('personnel_number', 'not_empty')		
			->rule('personnel_number', 'Model_Valid::tab_number',array(':value',$tab_numb))
			->rule('personnel_number', 'Model_Valid::tab_number_unique',array(':value',$tab_numb_old));
			
		if (!empty($post['password']))			
		{				
			$post			
			->rule('password', 'Model_Valid::login_valid',array($login ,$password))			
			->rule('password', 'min_length', array(':value', 6))
			->rule('password', 'max_length', array(':value', 16))
			->rule('password', 'Model_Valid::preg_match')
			->rule('password_confirm', 'not_empty')
			->rule('password_confirm', 'matches', array(':validation', 'password', 'password_confirm'));			
			}	
						
			// remove password if empty
            if (empty($_POST['password']))
            {
                unset($_POST['password']);
            }		
				
		if ($post->check())
		{
			if($register->reg($login))			
			{
			   $usertemp= ORM::factory('user',array('username'=> $login));
			   $user=$usertemp->UserStatus;			  

			   if ($user == 1)			   
			   { 	
			   		$register->changeorderstatus();
			   		$this->redirect('/admin/users');
			   }
			   
			   else			   
			   {	
			   			   	
			   	$this->redirect('/admin/users');
			   	
			   }
			}	
		}			
		// Errors list
        View::set_global('errors', $post->errors('validation'));		
		$roles = $register->find_role();			
		$this->content= View::factory('templates/admin/users/form')
		->set(array(
				'item' => $post->data(),
				'roles' => $roles,
					)
		);	  	
		$this->styles = array('media/css/style.css' => 'screen');	
}
	
	public function action_search()	
	{	
		$tab_numb=Arr::get($_POST,'search','');
		// Load users list query
		$users = ORM::factory('user')
		->where('personnel_number', "LIKE ", '%'. $tab_numb .'%')
		->reset(FALSE);
	
		// Create pagination object
		$pagination = Pagination::factory(array(
				'group' => 'admin',
				'total_items' => $users->count_all(),
		));
	
		// Modify users list query
		$users = $users
		->order_by('username', 'ASC')
		->offset($pagination->offset)
		->limit($pagination->items_per_page)
		->find_all();
	
		// Set content template
		$this->content=View::factory('templates/admin/users/list', array(
				'items' => $users,
				'pagination'=>$pagination,
				'search'=>View::factory('templates/admin/users/sereachview'),
	
		));
		$this->styles = array('media/css/bootstrap.css' => 'screen');
		$this->title ="Список пользователей";
		
		
	}
} // End Admin Users
