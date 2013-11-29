<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Welcome extends Controller_Front {

	private $error_code = 0;
	public function action_index()
	{	
		
		unset($_SESSION['menu']);
		if(Auth::instance()->logged_in())
		{
			$this->redirect('/menu');
		}
		// если сейчас больше 14 часов
		if(date("H")>14)
		{
			// выводим завтрашнее меню
			$_SESSION['mk_order_menu_date'] = date("Y-m-d", strtotime(" + 1 day"));
		}
		else
		{
			// сегодняшнее
			$_SESSION['mk_order_menu_date'] = date("Y-m-d");
		}
		$model_menu = new Model_Menu();
		$menu = $model_menu->get_menu($_SESSION['mk_order_menu_date']);
		if (empty($menu)) {
			$this->error_code = 6;
		}
		$this->content = View::factory('welcome/menu')->bind('error_code', $this->error_code)->bind('menu',$menu); 
		$this->title='Меню';
	}

} // End Welcome
