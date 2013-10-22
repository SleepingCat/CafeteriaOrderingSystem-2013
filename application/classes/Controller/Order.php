<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Order extends Controller_Front
{
	private $tmpuser;
	
	public function before()
	{
		Session::instance();
		$this->tmpuser = new Model_tmpuser();
		parent::before();
	}
	
	public function action_index()
	{
		$orders = (new Model_Order())->get_orders($this->tmpuser->get_user()['Id']);
		$this->content = View::factory('order/order')->bind('orders', $orders);
	}
	
	public function action_cart()
	{
		$this->content = View::factory('order/cart');
	}
	
	public function action_cancel()
	{
		$model_order = new Model_Order();
		$model_order->cancel_order(Request::current()->param('id'), $this->tmpuser->get_user()['Id']);
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
		$this->content = View::factory('order/confirm')->bind('options', $options);
		if (isset($_POST['btn_confirm']))
		{
			//TODO: сделать валидацию
			$_SESSION['type_payment'] = $_POST['type_payment'];
			if ($_POST['type_payment'] == 2) {
				$_SESSION['delivery_time'] = $_POST['delivery_time'];
			}

			$model_order->make_order($_SESSION['order'], $this->tmpuser->get_user()['Id'],$_SESSION['menu_id'], $_SESSION['menu_date'],$this->tmpuser->get_user()['Dislocation'], $_POST['delivery_time']);
			$_SESSION['order'] = null;
			$this->redirect("http://".$_SERVER['HTTP_HOST']."/order");
		}
	}
	
	public function desu($data)
	{
		echo '<pre>';
		print_r($data);
		echo '</pre>';
	}
}