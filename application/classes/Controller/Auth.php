	<?php defined('SYSPATH') or die('No direct script access.');

	/**
	 * Класс авторизации пользователей
	 * @author Babur
	 *
	 */
	class Controller_Auth extends Controller_Front{

		public function action_index()
		{					
			$data["error"]='';			
			$auth=Auth::instance();
		
			/**
			 * Если пол-й авторизован,то на гл. страницу его редиеректим
			 */
		 if($auth->logged_in())		 
		 {      
		 	
		  $this->redirect('');	
		  	
		 }
		 else		  
		  {     /**
		  		* Если пользователь нажал кнопку type="submit" но форме авторизации
		  		*/
		  		if (isset($_POST['subm']))		  			
				{ 
					/**
					Запоминаем переменные с текстовых полей
					 */
				  $login=Arr::get($_POST,'login','');				  
				  $password=Arr::get($_POST,'password','');				  
				  $usertemp= ORM::factory('user',array('username'=> $login));				
				  $user=$usertemp->user_status;				  

				  if ($user != 0)
				  {
				  	 $data["error"]="looser";
				  }
				  
				  else
				  {				  	
				  /**
				   * Авторизуем пл-ля с помощью модуль auth, обращаемся к методу login
				   */
				  if($auth->login($login,$password))
				{		/**
						Если авторизация прошла успешно, редиректим рользователя на нужный контролл(на который он заходил когда не был авторизован)
						*/					 
					$session = Session::instance();
				 	$auth_redirect=$session ->get('auth_redirect','');
					$session-> delete('auth_redirect');				  
					$this->redirect($auth_redirect);
				}	
							
				else
				 { 
				   $data["error"]="error"; 
				 }
 				 
			    }				 
			}		
		  }	
			$this->content=View::factory('templates/auth/authview')
			->set('error',$data["error"]);
			 $this->styles = array('media/css/authview.css' => 'screen');
			$this->title ="Авторизация";
		}				
		/**
		 * Разлогиниваемся
		 */
		public function action_logout()
		{   $auth=Auth::instance();	
	      	$auth->logout();	
			session_unset( );
			 session_destroy( )	;		
			$this->redirect('');           			
		}	
		/**
		 * Хэш-фукция пароля admin,оставлю в отладочных целях
		 */
	        public function action_hash()
		{
	       $auth=Auth::instance();
	      
			$pass1=$auth->hash_password('admin');
	        $this->content=$pass1 ;	
			;
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
