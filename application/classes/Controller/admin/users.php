<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Users extends Controller_Front {

    /**
     * Users List Action
     */
	/**TODO Проанализировать класс возможно что то вынести в модель**/
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
           
         ->offset($pagination->offset)
            ->limit($pagination->items_per_page)
            ->find_all();
				
        // Set content template
       $this->content=View::factory('templates/admin/users/list', array(
            'items' => $users,
             'pagination'=>$pagination,			
		
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
			throw new HTTP_Exception_404('User not found.');
		}

		// Get user
		$user = ORM::factory('user', $user_id);
		if (!$user->loaded())
		{
			throw new HTTP_Exception_404('User not found.');
		}	

		// Delete user
		$user->delete();

		// Redirect to base page
		   $this->redirect('Admin_Users');
	}

    /**
     * Create user action
     */
    public function action_new()
	{     $data["errors"]=array();			 
            if (isset($_POST['subm']))
         {              
		  		               			
            // remove password if empty
			if (empty($_POST['password']))
			{
				unset($_POST['password']);
			}			
	
		   $register= new Model_Register();	
		   
			if($register->reg())
			 {	
			 	  $this->redirect('Admin_Users');	                 				 
			 }
			 else			 
			 {				 
			 $data["errors"]=$register->errors;	
			 }        
	  }   
	  	
	$roles = ORM::factory('role')->order_by('name', 'ASC')->find_all();
	
	$this->content=View::factory('templates/admin/users/regview')
	->set(array(
				'item' => array_merge( array('roles' => array())),
				'roles' => $roles,
				))
		->set('errors',$data["errors"]);
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
		$data["errors"]=array();
		// Get user id
		$user_id = $this->request->param('id');
		
		if (!$user_id)
		{
			throw new HTTP_Exception_404('User not found.');
		}
		
		// Get user
		$user = ORM::factory('user', $user_id);
		if (!$user->loaded())
		{
			throw new HTTP_Exception_404('User not found.');
		}

		// User roles
		$item['roles'] = array();
		foreach ($user->roles->find_all() as $role)
		{
			$item['roles'][] = $role->id;
		} 

	    // remove password if empty
		if (empty($_POST['password']))
		{
			unset($_POST['password']);
		}
		
		// Roles list
		$roles = ORM::factory('role')->order_by('name', 'ASC')->find_all();

		// Set content template
		$this->content=View::factory('templates/admin/users/edit')

->set(array(
			'item' => array_merge($user->as_array(), $item),
			'roles' => $roles,
		))
		->set('errors',$data["errors"]);
$this->styles = array('media/css/style.css' => 'screen');
$this->title ="Редактрование пользователя";									
	}

    /**
     * Save user action
     *
     * @throws HTTP_Exception_404
     */
    public function action_save()
	{	
	    $data["errors"]=Array();
	    // Protect page
		if ($this->request->method() !== Request::POST)
		{
			throw new HTTP_Exception_404('Page not found.');
		}
		
		
        // Back
        if ($this->request->post('back'))
        {
           $this->redirect('/admin/users/index');
        }        
			  /** @var Model_User $user **/
			$user = ORM::factory('user', Arr::get($_POST, 'id'));			
							
            // remove all roles
		    $user->remove('roles');
		   $register= new Model_Register();			
			
			if($register->reg())
			 {	
			  
			 	 $this->redirect('/admin/users');	                 				 
			 }
			 else			 
			 {	
			 	 
			 $data["errors"]=$register->errors	;

			 }			 	
		
	    $item['roles'] = array();
		foreach ($user->roles->find_all() as $role)
		{
			$item['roles'][] = $role->id;
		}	
        
	$roles = ORM::factory('role')->order_by('name', 'ASC')->find_all();  
			
	$this->content=View::factory('templates/admin/users/edit')
	->set(array(
				'item' => array_merge($user->as_array(), $item),
				'roles' => $roles,	
				))
				
				->set('errors',$data["errors"]);	
	$this->styles = array('media/css/style.css' => 'screen');

	}
} // End Admin Users
