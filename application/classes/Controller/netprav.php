<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Netprav extends Controller_Checkinput {

	//public $template='templates/default';	
	public function action_index()
	{
		 $this->content=View::factory('templates/admin/netpravview'); 
		 $this->title ="Админ-панель";
		  $this->styles = array('media/css/style.css' => 'screen');	
	}

}
