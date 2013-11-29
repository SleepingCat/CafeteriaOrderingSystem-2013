<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Menu extends Controller_Checkinputusers
{
	private $error_code = 0;
	private $view;
	
	public function before()
	{
		// Подключаем скрипт с датапикером
		$this->scripts = Arr::merge(array(Route::get('media')->uri(array('file' => 'js/jquery.ui.datepicker-ru.min.js'))), $this->scripts);
		$this->view = View::factory('order/index')->bind('error_code', $this->error_code);
		parent::before();
	}
	
	/**
	 * экшэн, на котором предлагается выбрать дату меню
	 */
	public function action_index()
	{
		unset($_SESSION['menu']);
		if(!isset($_SESSION['mk_order_menu_date']))
		{
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
		}
		$model_menu = new Model_Menu();
		$menu = $model_menu->get_menu($_SESSION['mk_order_menu_date']);
		if (empty($menu)) {
			$this->error_code = 6;
		}
		else 
		{
			$this->view->bind('menu', $menu);
		}
		// если пользователь выбрал дату меню
		if (isset($_POST['smbt']))
		{
			// Указал ли пользователь дату?
			if (isset($_POST['menu_date'])) {
				$input_date = trim($_POST['menu_date']);
			}
			// если не указал возвращаемся с ошибкой
			if(empty($input_date))
			{
				$this->error_code = 1;
			}
			// Формат даты неверен?
			elseif(!Valid::date($input_date))
			{
				$this->error_code = 2;
			}
			else
			{
				$input_date = date_parse($input_date);
				$input_date_in_seconds = mktime(0,0,0,$input_date['month'],$input_date['day'],$input_date['year']);
				
				// Если введеная дата больше текущей на 2 недели
				if ($input_date_in_seconds > time() + 60*60*24*14) {
					$this->error_code = 3;
				}
				// Или если введенная дата меньше текущей
				elseif ($input_date_in_seconds < mktime(0, 0, 0, date("m")  , date("d"), date("Y")))
				{
					$this->error_code = 4;
				}
			}
			// Если ошибок нет запихиваем меню в сессию и редиректим на отображение
			if($this->error_code < 1)
			{
				$menu_date = $input_date['year'].'-'.$input_date['month'].'-'.$input_date['day'];
				$model_menu = new Model_Menu();
				$menu=$model_menu->get_menu($menu_date);
				$_SESSION['mk_order_menu_date'] = $menu_date;
				$_SESSION['menu'] = $menu;
				$_SESSION['menu_id'] = $model_menu->get_menu_id();
				$_SESSION['mk_order_id'] = null;
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
	
	
	/**
	 * Отображает меню для заказа блюд
	 */
	public function action_show()
	{

		if(!isset($_SESSION['mk_order_menu_date']))
		{
			$_SESSION['mk_order_menu_date'] = date("Y-m-d");
			print_r($_SESSION['mk_order_menu_date']);
		}
		$model_menu = new Model_Menu();
		$menu = $model_menu->get_menu($_SESSION['mk_order_menu_date']);
		if (empty($menu)) {
			$this->error_code = 6;
			$this->content = $this->view;
		}
		else
		{
			$this->content = View::factory('order/menu')->bind('menu', $menu);
		}
	}
	
	/**
	 * Обработчик кнопки "Добавить"
	 * Добавляет выбранное блюдо к заказу
	 */
	public function action_add_to_cart()
	{
		if (isset($_POST['smbt_make_order']))
		{
			$model_menu = new Model_Menu();
			$menu = $model_menu->get_menu($_SESSION['mk_order_menu_date']);
			$order = $_POST['cart'];
			print_r($order);
			foreach ($order as $key => $value)
			{
				if (preg_match('/^[0-9]{1,2}$/', $value) != 1)
				{
					$this->error_code = 1;
					break;
				}
				if ($value > 0)
				{
					$_SESSION['order'][$key."|".$_POST['portion']] = $menu[$key];
					$_SESSION['order'][$key."|".$_POST['portion']]['servings_number'] = $value;
					$_SESSION['order'][$key."|".$_POST['portion']]['portion'] = $_POST['portion'];
				}
			}
		}
		$this->action_show($this->error_code);
		return;
	}
}