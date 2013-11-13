<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Main extends Controller_Checkinputadmin  {
	
	public function action_index()
	{	
		 $this->content=View::factory('templates/admin/adminview');
	  	 $this->styles= array('media/css/style.css' => 'screen');	
	  	 $this->title ="Админская панель";
	}	
	public function action_email()
	{		 
		$config = Kohana::$config->load('email');
    	Email::connect($config); 
    	
		
    	$to =$this->user['email'];		
		
		//$from='cafeteria-ordering-system2013@yandex.ru';
		
    	$subject = "Сообщение от Коханой..т.е. Коханы.";   		 
   		$message = 'Проверка12345';	
   		$mail=new Model_Email();		 	   		
		$mail->sendemail( $to, $subject, $message);    
	}	
	
}

// End Welcome
