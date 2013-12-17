<?php
header('Access-Control-Allow-Origin: *');
class Controller_Handler extends Controller
{
	private $session = null;
	public function before() 
	{
		$this->session = Session::instance();
		parent::before();
	}
	
	public function action_test()
	{
		$m = new Model_Order();
		echo '<pre>';
		print_r($m->get_order(8, 29));
		echo '</pre>';
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
					$tmp = $key."|".$_POST['portion'];
					if (isset($_SESSION['order'][$tmp]['servings_number']) && $_SESSION['order'][$tmp]['servings_number'] != null){$tmp2 = $_SESSION['order'][$tmp]['servings_number'];}
					else { $tmp2 = 0;}
					$_SESSION['order'][$key."|".$_POST['portion']] = $menu[$key];
					$_SESSION['order'][$tmp]['servings_number'] = $value + $tmp2;
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
			$summ = 0;?>
			<script>
			$(document).ready(function(){
				$( ".CartItem" ).tooltip(
				{
					content: function() 
					{	
						return "Нажмите на блюдо для его удаления";			
					},
					tooltipClass: "OrderTooltip",
					track: false
				});
			});	
			</script>						
			<ul class="CartList">
			<? foreach ($_SESSION['order'] as $key => $value)
			{?>
				<li class="CartItem" title="" <? echo "onclick=\"remove_from_cart('".$key."')\""?>>
				<? echo $value['dish_name']."(<span style=\"color:blue;\">".$value['portions'][$value['portion']]['price']."</span>) x".$value['servings_number'];
				$summ += $value['portions'][$value['portion']]['price']*$value['servings_number'];
			}?></li>
			</ul>
			<? echo "Итого: <span style=\"color:blue;\">".$summ."</span><br>";
			echo "<a href=\"http://".$_SERVER['HTTP_HOST']."/order/confirm\" class=\"EntBut EntBut-color\" style=\"width: 80px; line-height: 20px; font-size: 14px; margin: 5px;\">Оформить</a>
			<button class=\"EntBut EntBut-color\" style=\"width: 80px; line-height: 20px; font-size: 14px; margin: 5px;\" onclick=\"cart_clear()\">Очистить</button>";
		}
		else
		{
			echo "Пусто =(<br>";
		}			
	 }
}
?>