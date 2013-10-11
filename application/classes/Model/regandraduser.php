
<?php defined('SYSPATH') or die('No direct script access.');

class Model_Regandraduser  
{

public function reg()
 {  	 
		try
		{	      
			$user = ORM::factory('user', Arr::get($_POST, 'id'));			
            // update user			
			$user->values($_POST, array('username','email', 'password','name','surname','patronymic','building','floors','number','personnel_number'))->save();
			//remove all roles
			$user->remove('roles');
			
			// add new roles
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
 
 public  function find_role()
 {
 
 	$roles=ORM::factory('role')->order_by('name', 'ASC')->find_all();
 
 	return $roles;
	 
 
 }
 
			 
}