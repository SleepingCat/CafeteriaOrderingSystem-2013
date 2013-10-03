<?php defined('SYSPATH') or die('No direct script access.');

class Model_Register 
{	
	public function reg()
	{		
		
	try
		{			
			
	    $myuser = ORM::factory('user', Arr::get($_POST, 'id')); 	    
		$myuser->values($_POST, array('username', 'email', 'password'))->save();		
	
			foreach (Arr::get($_POST, 'roles', array()) as $role)
			{			
				$myuser->add('roles', $role);
			}
		
		     return TRUE;		
		}
		
		catch(ORM_Validation_Exception $e)
		{
			$this->errors=$e->errors('validation');		 ;
			return false;	
		
		}     		    	
	
	}
	
}

// End Welcome
