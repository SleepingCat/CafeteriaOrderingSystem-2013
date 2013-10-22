<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Welcome extends Controller_Front {

	public function action_index()
	{	
		$this->content = View::factory('welcome/index'); 
		$this->title='Главная страница';
	}

} // End Welcome
