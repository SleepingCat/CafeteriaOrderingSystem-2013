<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Main extends Controller_Checkinput  {
   
	
	public function action_index()
	{	
		 $this->content=View::factory('templates/admin/adminview');
	  	 $this->styles= array('media/css/style.css' => 'screen');	
	}
	
}

// End Welcome
