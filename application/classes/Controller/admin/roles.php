<?php defined('SYSPATH') or die('No direct script access.');

/**TODO Проанализировать класс возможно что то вынести в модель**/

class Controller_Admin_Roles extends Controller_Front {
	
	public function action_index()
	{
		// Загружаем роли
		$users = ORM::factory('role')
		->reset(FALSE);
	
		// Модифицировать роли
		$pagination = Pagination::factory(array(
	        'group' => 'admin',
            'total_items' => $users->count_all(),
        ));	

        // Modify users list query
        $users = $users
            //->order_by('role', 'ASC')
          //->order_by('email', 'ASC')
         ->offset($pagination->offset)
            ->limit($pagination->items_per_page)
            ->find_all();
	
		 // Set content template
       $this->content=View::factory('templates/admin/roles/rolesList', array(
            'items' => $users,
             'pagination'=>$pagination,			
		
        ));
	    $this->styles = array('media/css/bootstrap.css' => 'screen');
		$this->title ="Список ролей";
		 
	}
	/**
	 * Delete role action
	 */
	public function action_delete()
	{
		// Get role id
		$role_id = $this->request->param('id');
		if (!$role_id)
		{
			throw new HTTP_Exception_404('Роль не найдена.');
		}
	
		// Get user
		$role = ORM::factory('role', $role_id);
		if (!$role->loaded())
		{
			throw new HTTP_Exception_404('Роль не найдена.');
		}	
		
		// Delete user
		$role->delete();
	
		// Redirect to base page
		$this->redirect('Admin_Roles');
	}
	
	/**
	 * Edit user action
	 *
	 * @throws HTTP_Exception_404
	 */
    public function action_edit()
	{
		$data["errors"]=array();
		// Get role id
		$role_id = $this->request->param('id');
		if (!$role_id)
		{
			throw new HTTP_Exception_404('Role not found.');
		}

		// Get role
		$role = ORM::factory('role', $role_id);
		
		if (!$role->loaded())
		{
			throw new HTTP_Exception_404('Role not found.');
		}

		// Set content template
		$this->content=View::factory('templates/admin/roles/edit')

		 ->set(array(
			'item' => $role->as_array(),
		))
		->set('errors',$data["errors"]);
		 						
	}
	
	public function action_new()
	{
		$data["errors"]="";
		// New role
		$role = ORM::factory('role');
	
		// Set content template
	$this->content=View::factory('templates/admin/roles/new')

	 ->set(array(
				'item' => $role->as_array(),
		))
	->set('errors',$data["errors"]);
	
	}
	
	public function action_save()
	{
		// Protect page
		if ($this->request->method() !== Request::POST)
		{
			throw new HTTP_Exception_404('Page not found.');
		}
	
		// Back
		if ($this->request->post('back'))
		{
			$this->redirect('/admin/roles');
		}
	
		// create and configure form validation
		$post = Validation::factory($this->request->post())
		->labels(array(
				'name' => __('Name'),
				'description' => __('Description'),
		))
		->rule('name', 'not_empty')
		->rule( 'name', 'alpha');
	
		// check validation
		if ($post->check())
		{
			/** @var Model_Role $role **/
			$role = ORM::factory('role', Arr::get($post->data(), 'id'));
	
			// update role
			$role->values($post->data(), array('name', 'description', ))->save();
	
			// message
			Session::instance()
			->set('message', Arr::get($post->data(), 'id') ? 'Role updated successfully.' : 'Role created successfully.')
			->set('message_type', 'success');
	
			// redirect to list page
			$this->redirect(URL::site('/admin/roles'));
		}
	
		// Errors list
		View::set_global('errors', $post->errors('validation'));
	
		// Set content template
		$this->content=(View::factory('templates/admin/roles/' . (Arr::get($post->data(), 'id') ? 'edit' : 'new'),
				array('item' => $post->data(),)
		));
	}
	
	
}