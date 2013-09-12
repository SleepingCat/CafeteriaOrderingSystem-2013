<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Welcome extends Controller_Front {

	public function action_index()
	{
		//$data = ORM::factory('ormexample')->getinfo();
		$this->content = View::factory('welcome/index')->bind('data', $data);
	}

} // End Welcome
