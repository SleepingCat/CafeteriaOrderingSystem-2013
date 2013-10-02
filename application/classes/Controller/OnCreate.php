<?php defined('SYSPATH') or die('No direct script access.');

class Controller_OnCreate extends Controller_Front {

	public function action_index()
	{
		$this->content = View::factory('createMenu/onCreate');

	}
}