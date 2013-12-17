<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Order extends Controller_Checkinputusers
{	
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
	
	public function action_detail()
	{
		$order_id = Request::current()->param('id');
		$model_order = new Model_Order();
		$order = $model_order->get_order($this->user['id'],$order_id);
		$this->content = View::factory('order/detail')->set('order_detail',$order);
	}
	
	public function action_clear()
	{
		unset($_SESSION['order']);
		unset($_SESSION['mk_order_menu_date']);
		unset($_SESSION['mk_order_id']);
		unset($_SESSION['menu_id']);
		$this->redirect("/order");
	}
	
	/**
	 * Удаляет блюдо из заказа
	 * Использование //order/remove/<Id блюда>
	 */
	public function action_remove()
	{
		unset($_SESSION['order'][Request::current()->param('id')]);
		$this->redirect($_SERVER['HTTP_REFERER']);
	}
	
	/**
	 * Подтверждение заказа (обработчик кнопки "Оформить" корзины)
	 */
	public function action_confirm()
	{
		if (empty($_SESSION['order'])) {
			$this->redirect("http://".$_SERVER['HTTP_HOST']."/menu/show");
		}
		$error_code = 0;
		$model_order = new Model_Order();
		$options = $model_order->get_delivery_periods();
		$view = View::factory('order/confirm')->bind('options', $options)->bind('error_code',$error_code);
		if (!(empty($this->user['num_office']) && empty($this->user['floors']) && empty($this->user['building'])))
		{
			$view->set('delivery_point',"Здание ".$this->user['building']." Этаж ".$this->user['floor']." Офис ".$this->user['office']);
		}

		if (isset($_POST['btn_confirm']))
		{
			//TODO: сделать валидацию
			if (isset($_SESSION['mk_order_id'])) {
				$error_code = $model_order->update_order($_SESSION['mk_order_id'], $_SESSION['order'], $this->user['id'],$_SESSION['menu_id'], $_SESSION['mk_order_menu_date'],$_POST['delivery_point'], $_POST['delivery_time']);
			}
			else
			{
				$error_code = $model_order->make_order($_SESSION['order'], $this->user['id'],$_SESSION['menu_id'], $_SESSION['mk_order_menu_date'],$_POST['delivery_point'], $_POST['delivery_time']);
			}
			if ($error_code == 0) 
			{
				unset($_SESSION['order']);
				unset($_SESSION['mk_order_id']);
				$this->redirect("http://".$_SERVER['HTTP_HOST']."/order");
			}
		}
		$this->content = $view;
	}
	
	public function action_edit()
	{
		$order_id = Request::current()->param('id');
		$model_order = new Model_Order();
		$order = $model_order->get_order($this->user['id'],$order_id);
		$_SESSION['mk_order_menu_date'] = $order['delivery_date'];
		$_SESSION['mk_order_id'] = $order_id;
		$_SESSION['order'] = $order['dishes'];
		$this->redirect('http://'.$_SERVER["HTTP_HOST"].'/menu/show');
	}
	
	public function action_desu()
	{$order_id = Request::current()->param('id');
		$m = new Model_Order();
		$order = $m->get_order($this->user['id'],$order_id);
		$this->desu($order);
	}
	
	public function desu($data)
	{
		echo '<pre>';
		print_r($data);
		echo '</pre>';
	}
} // End Welcome
