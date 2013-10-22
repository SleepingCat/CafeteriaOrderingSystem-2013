<div>
	Ваш заказ:<br>
<?php
/*
 * тут редактирование уже оформленного заказа
 */
	$summ = 0;
	foreach ($_SESSION['order'] as $key => $value)
	{
		echo $value['DishName']."(".$value['Price'].") x".$value['Amount']."<a href=\"order/remove/".$key."\">Удалить</a><br>";
		$summ += $value['Price']*$value['Amount'];
	}
	echo "Итого: ".$summ."<br>";
?>
<a href="order/edit"><button>Изменить</button></a>
<a href="order/confirm"><button>Оформить</button></a>
<a href="order/clear"><button>Очистить</button></a>
</div>