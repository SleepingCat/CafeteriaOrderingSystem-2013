<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Menu extends Controller_Checkinputusers
{
	private $error_code = 0;
	private $view;
	
	public function before()
	{
		$session = Session::instance();
		$this->view = View::factory('order/index')->bind('error_code', $this->error_code);
		parent::before();
	}
	
	public function action_index()
	{
		if (isset($_POST['smbt']))
		{
			$input_date = trim($_POST['menu_date']);
			if(empty($input_date))
			{
				$this->error_code = 1;
			}
			elseif(preg_match('/^[0-3]{0,1}[0-9].[0-1]{0,1}[0-9].([0-9]{2})|([0-9]{4})$/', $input_date) < 1)
			{
				$this->error_code = 2;
			}
			else
			{
				$input_date = date_parse($input_date);
				$input_date_in_seconds = mktime(0,0,0,$input_date['month'],$input_date['day'],$input_date['year']);
				if ($input_date_in_seconds > time() + 60*60*24*14) {
					$this->error_code = 3;
				}
				elseif ($input_date_in_seconds < time())
				{
					$this->error_code = 4;
				}
			}
			if($this->error_code < 1)
			{
				$menu_date = $input_date['year'].'-'.$input_date['month'].'-'.$input_date['day'];
				$model_menu = new Model_Menu();
				$menu=$model_menu->get_menu($menu_date);
				$_SESSION['menu_date'] = $menu_date;
				$_SESSION['menu'] = $menu;
				$_SESSION['menu_id'] = $model_menu->get_menu_id();
				if (count($menu) < 1) {
					$this->error_code = 3;
				}
				else
				{

					$this->redirect("http://".$_SERVER['HTTP_HOST'].'/menu/show');
				}
			}
		}
		$this->content = $this->view;
	}
	
	public function action_show($error_code = NULL)
	{
		if(isset($_SESSION['menu_date']))
		{
			$this->content = View::factory('order/menu')
			->set('menu', $_SESSION['menu'] )
			->bind('error_code', $error_code );
		}
	}
	
	public function action_add_to_cart()
	{
		if (isset($_POST['smbt_make_order']))
		{
			$model_menu = new Model_Menu();
			$menu = $model_menu->get_menu($_SESSION['menu_date']);
			$order = $_POST['cart'];
			foreach ($order as $key => $value)
			{
				if (preg_match('/^[0-9]+$/', $value) != 1)
				{
					$this->error_code = 1;
					break;
				}
				if ($value > 0)
				{
					$_SESSION['order'][$key] = $menu[$key];
					$_SESSION['order'][$key]['amount'] = $value;
				}
			}
		}
		$this->action_show($this->error_code);
		return;
	}
}