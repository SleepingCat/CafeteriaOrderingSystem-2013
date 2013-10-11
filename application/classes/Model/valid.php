<?php defined('SYSPATH') or die('No direct script access.');

/**
 * 
 * @author Babur
 *Эта модель для валидации полей добавления и редактирвоания пользовталей
 */
class Model_Valid 
{	
	 public function rules()
   {
   return array(
   'username'=>array(
   array('not_empty'), 
     array(array($this,'user_unique') ),),
  
  'email'=>array(array('not_empty'),
  array('email'),  
   array(array($this,'user_email') ),),  
  
      );
   
   } 
    public static  function preg_match($pass)
   {
      if (!preg_match("/^[-a-zA-Z0-9_!?*#$%&+]{0,}$/",$pass))   
	  {	  	
	  	return false;	  
	  }

	  else
	  {	  
	  	return true;
	  }		  
   }   
   
    public static function user_unique($username,$oldname)
   {  
	    if ($username != $oldname) 
	  {
   	    $usertemp= ORM::factory('user',array('username'=> $username));
		
		if($usertemp->loaded() )
			
	   	{	   	 
	  		 return FALSE;	      
	   	}
	   
	   else
		{   
			 return TRUE;   
		}   
	  }
	    else 
	    {
	       return  TRUE;
	    }
  }  
   public static function email_unique($email,$oldemail)
   {		
		if ($email != $oldemail)
	{	
		$usertemp= ORM::factory('user',array('email'=> $email));
		if($usertemp->loaded())
	   {   

	   	return FALSE;
	   	   
	   }
	   
	   else   
		   {   
			  return TRUE;   
		   } 
	}
	else { return  TRUE; }	  
  }  
  
  public static function tab_number($num)
   {		
		if($num >= 111111 and $num <=999999 )
	   {   
	   return TRUE;   
	   }
	   else   
		   {   
			  return false;   
		   }   
  }  
	 
	 public static function login_valid($login,$pass)
    {	
		if ($pass == $login)	
		{	
			return false;	
		}		
			else		
		{
			
		return true;
		
		}
    } 
    
    public static function tab_number_unique($tab,$oldtab)
    {
    	$usertemp= ORM::factory('user',array('personnel_number'=> $tab));
    
    	if ($tab <> $oldtab)
    	{
    		if($usertemp->loaded())
    		{
    
    			return FALSE;
    
    		}
    
    		else
    		{
    			return TRUE;
    		}
    	}
    	else { return  TRUE; }
    	 
    }
   
}
