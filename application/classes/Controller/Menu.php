<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Menu extends Controller_Checkinputusers {

	public function action_index()
	{
		$this->content = View::factory('menu/selectmenu')->set('title', "Выберите Меню");				
	}
	
	public function action_menuselect()
	{
		
		if($_POST['menu'] == "Меню1(19.03.2013)")
		{
			$menu = 'menu_data_emulation1.php';
		}
		else
		{
			$menu = 'menu_data_emulation2.php';
		}
		$this->content = View::factory('menu/menu')->set('menu', $menu)->set('title', $_POST['menu']);
		
	}

} // End Welcome
