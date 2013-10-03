<?php defined('SYSPATH') or die('No direct script access.');

class Controller_createMenu extends Controller_Front {

	public function action_index()
	{
		$this->content = View::factory('createMenu/createMenu')->set('title', " ������� ���� ����");

	}

	public function action_getRegistOfFood()
	{
		if($_POST['Date'] == '03.10.2013')
		{
			$regOfFood = 'registrOfFoodEmulation.php';
		}
		else 
		{
			$regOfFood = 'registrOfFoodEmulation.php1';
		}
		$this->content = View::factory('createMenu/registerOfFood')->set('regOfFood', $regOfFood)->set('title', "������ ����");
	}

} // End Welcome