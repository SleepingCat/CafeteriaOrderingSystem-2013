<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Order extends Controller_Checkinputusers
{
	public function before()
	{
		Session::instance();
		parent::before();
	}
	
	public function action_index()
	{
		$model_order = new Model_Order();
		$orders = $model_order->get_orders($this->user['id']);
		$this->content = View::factory('order/order')->bind('orders', $orders);
	}
	
	public function action_cart()
	{
		$this->content = View::factory('order/cart');
	}
	
	public function action_cancel()
	{
		$model_order = new Model_Order();
		$model_order->cancel_order(Request::current()->param('id'), $this->user['id']);
		$this->redirect("http://".$_SERVER['HTTP_HOST']."/order");
	}
	
	public function action_clear()
	{
		$_SESSION['order'] = null;
		$this->redirect($_SERVER['HTTP_REFERER']);
	}
	
	public function action_remove()
	{
		unset($_SESSION['order'][Request::current()->param('id')]);
		$this->redirect($_SERVER['HTTP_REFERER']);
	}
	
	public function action_confirm()
	{
		$model_order = new Model_Order();
		$options = $model_order->get_delivery_periods();
		$view = View::factory('order/confirm')->bind('options', $options);
		if (!(empty($this->user['num_office']) && empty($this->user['floors']) && empty($this->user['building'])))
		{
			$view->set('delivery_point',"Здание ".$this->user['building']." Этаж ".$this->user['floors']." Офис ".$this->user['num_office']);
		}
		if (isset($_POST['btn_confirm']))
		{
			//TODO: сделать валидацию
			//$_SESSION['delivery_type'] = $_POST['delivery_type'];
			//if ($_POST['type_payment'] == 2) {
			//	$_SESSION['delivery_time'] = $_POST['delivery_time'];
			//}

			$model_order->make_order($_SESSION['order'], $this->user['id'],$_SESSION['menu_id'], $_SESSION['menu_date'],$_POST['delivery_point'], $_POST['delivery_time']);
			$_SESSION['order'] = null;
			$this->redirect("http://".$_SERVER['HTTP_HOST']."/order");
		}
		$this->content = $view;
	}
	
	public function desu($data)
	{
		echo '<pre>';
		print_r($data);
		echo '</pre>';
	}
} // End Welcome
