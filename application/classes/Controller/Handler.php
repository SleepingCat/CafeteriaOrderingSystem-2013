<?php
header('Access-Control-Allow-Origin: *');
class Controller_Handler extends Controller
{
	private $session = null;
	public function before() 
	{
		$this->session = Session::instance(null,$_REQUEST['session']);
		parent::before();
	}
	
	public function action_add()
	{
		if (isset($_POST['cart'])) {

			$model_menu = new Model_Menu();
			$menu = $model_menu->get_menu($_SESSION['mk_order_menu_date']);
			$order = $_POST['cart'];
			foreach ($order as $key => $value)
			{
				if (preg_match('/^[0-9]{1,2}$/', $value) != 1)
				{
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
		$this->action_index();
	}
	
	public function action_remove()
	{
		unset($_SESSION['order'][Request::current()->param('id')]);
		$this->action_index();
	}
	
	function action_clear()
	{
		unset($_SESSION['order']);
		$this->action_index();
	}
	
	function action_index()
	{
		if (isset($_SESSION['order']))
		{
			$summ = 0;
			foreach ($_SESSION['order'] as $key => $value)
			{
				echo $value['dish_name']."(".$value['portions'][$value['portion']]['price'].") x".$value['servings_number']."<button onclick=\"remove_from_cart('".$key."')\">Удалить</button><br>";
				$summ += $value['portions'][$value['portion']]['price']*$value['servings_number'];
			}
			echo "Итого: ".$summ."<br>";
			echo "<button onclick=\"cart_clear()\">Очистить</button>
		<a href=\"http://".$_SERVER['HTTP_HOST']."/order/confirm\"><button>Оформить</button></a>";
		}
		else
		{
			echo "Пусто =(<br>";
		}
	}
}
?>