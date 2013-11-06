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
		echo $value['dish_name']."(".$value['price'].") x".$value['servings_number']."<a href=\"http://".$_SERVER['HTTP_HOST']."/order/remove/".$key."\">Удалить</a><br>";
		$summ += $value['price']*$value['servings_number'];
	}
	echo "Итого: ".$summ."<br>";
}
?>
<a class="btn_submit" href="<?php echo "http://".$_SERVER['HTTP_HOST']."/order/clear" ?>"><button>Очистить</button></a>
<a href="<?php echo "http://".$_SERVER['HTTP_HOST']."/order/confirm"?>"><button>Оформить</button></a>
</div>