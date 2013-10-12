<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Welcome extends Controller_Front {

	public function action_index()
	{
		
		//$auth = Auth::instance();
		//if($auth->logged_in())
		$this->content = View::factory('welcome/index');
		//else
		//if($auth->logged_in() == 0)  $this->redirect('auth');                  

       
	}

} // End Welcome
