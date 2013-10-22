<div>
	Ваш заказ:<br>
<?php
/*
 * Корзина с возможностью редактирования до оформления заказа
 */
 if (isset($_SESSION['order']))
{
	$summ = 0;
	foreach ($_SESSION['order'] as $key => $value)
	{
		echo $value['dish_name']."(".$value['price'].") x".$value['amount']."<a href=\"http://".$_SERVER['HTTP_HOST']."/order/remove/".$key."\">Удалить</a><br>";
		$summ += $value['price']*$value['amount'];
	}
	echo "Итого: ".$summ."<br>";
}
?>
<a href="<?php echo "http://".$_SERVER['HTTP_HOST']."/order/clear" ?>"><button>Очистить корзину</button></a>
<a href="<?php echo "http://".$_SERVER['HTTP_HOST']."/order/confirm"?>"><button>Оформить</button></a>
</div>