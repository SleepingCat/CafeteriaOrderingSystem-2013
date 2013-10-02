<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Welcome extends Controller_Front {

	public function action_index()
	{
		//$data = ORM::factory('ormexample')->getinfo();
		$this->content = View::factory('welcome/index');
		
                   

        // Add defaults to template variables.        
        //$this->styles  = array_reverse(array_merge($this->styles, $styles));
	}

} // End Welcome
