<div align=left style = "border:1px solid black; margin:30px; padding-left:10px;">
<div style="right:10px; float:right; top:55px; position:relative">
	<a onclick="return confirm('Отменить заказ?')" href=<?php echo "http://".$_SERVER['HTTP_HOST']."/order/cancel/".$order_detail['order_id']?>><button>Отменить</button></a><br>
	<?php if($order_detail['order_status'] == OrderStatus::NewOrder) echo '<a href=http://'.$_SERVER['HTTP_HOST'].'/order/edit/'.$order_detail['order_id'].' stule="top:10px"><button>Редактировать</button></a>'; ?>
</div>
<style>
	td
	{
		border:1px solid black
	}
</style>
<?php 

echo "<div align=center style=\"font-size:18pt; \"><strong>Заказ ".$order_detail['order_id']."</strong></div><br>"
."Статус: ".$order_detail['order_status']."<br>"
."Время доставки: ".$order_detail['delivery_date']." ".$order_detail['delivery_time']."<br>"
."Место доставки: ".$order_detail['delivery_point']."<br>"
."Состав заказа:<br>"
."<div style=\"border:1px solid black; padding-left:10px; margin:10px 10px 10px 0\">"
."<table> <tr><td>Блюдо</td><td>Размер порции</td><td>Цена</td><td>Количество</td></tr>";
	foreach ($order_detail['dishes'] as $dish)
	{
		//echo $dish['dish_name']."(".$dish['portions'][$value['portion']]['portion_type'].") ".$value['portions'][$value['portion']]['price']."x".$value['servings_number']."<br>";
		echo "<tr><td>".$dish['dish_name']."</td><td>".$dish['type_name']."</td><td>".$dish['price']."</td><td>".$dish['servings_number']."</td></tr>";
	}
echo "</table></div>"
		."Сумма: ".$order_detail['total_price'];
?>
</div>