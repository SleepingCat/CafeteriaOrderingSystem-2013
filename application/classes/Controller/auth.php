	<?php defined('SYSPATH') or die('No direct script access.');

	class Controller_Auth extends Controller_Front{
/*

Объявляю template чтобы не было зацикливания redirecta

*/
	 // пока закомичю public $template='templates/default';	

		public function action_index()
		{				
		$data=array(); 			
		$auth=Auth::instance();		
		
		 if($auth->logged_in())		 
		 {      
		  $this->redirect('');		
		 }	

		 else		  
		  {     if (isset($_POST['subm']))
				{ 
				  $login=Arr::get($_POST,'login','');
				  
				  $password=Arr::get($_POST,'password','');
				  
				  if($auth->login( $login,$password))
				{				
				 $session = Session::instance();
				 $auth_redirect=$session ->get('auth_redirect','');
				 $session-> delete('auth_redirect');				  
				 $this->redirect(URL::site($auth_redirect));	             	  
				  
				}				
				else
				 { 
				   $data["error"]="error"; 
				 }
 				 
			    }				 
			}				
			 $this->content=View::factory('templates/authview',$data);
			 $this->styles = array('media/css/style.css' => 'screen');
			$this->title ="Авторизация";        
           	
		}				
		
		public function action_logout()
		{
	       $auth=Auth::instance();	
	        $auth->logout();
	        $this->content= "Разлогинились";
	        $this->title = 'Разлогинились';	
			$this->user = "Вы теперь гость";
           			
		}	
	        public function action_hash()
		{
	       $auth=Auth::instance();	
	      
			$pass1=$auth->hash_password('admin');
	        $this->content=$pass1 ;		
		}				
		
		/*public function action_reg()
	  {
			 $data=array();
			 
            if (isset($_POST['subm']))
         { 
			 $log=Arr::get($_POST,'log','');
						
			$pass=Arr::get($_POST,'pass','');	

            $email =Arr::get($_POST,'email','');			
			
			$auth=Auth::instance();			
			
			$pass1=$auth->hash_password($pass);			
			
			$register= new Model_Register();
			
			if($register->reg($log, $pass1,'1',$email))
			 {	
			 	                				 
			 }
			 else
			 
			 {
			 	 $data["errors"]=$register->errors;
			 }			 
	    }
			 $this->template->contect= View::factory('regview',$data);		
		
	  }*/
		

	} // End Welcome
