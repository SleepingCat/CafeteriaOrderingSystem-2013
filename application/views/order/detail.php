<div align=left style = "border:1px solid black; margin:30px; padding-left:10px;">
<div style="right:10px; float:right; top:55px; position:relative">
	<a onclick="return confirm('Отменить заказ?')" href=<?php echo "http://".$_SERVER['HTTP_HOST']."/order/cancel/".$order_detail['order_id']?>><button>Отменить</button></a><br>
	<a href=# stule="top:10px"><button>Редактировать</button></a>
</div>
<?php 

echo "<div align=center style=\"font-size:18pt; \"><strong>Заказ ".$order_detail['order_id']."</strong></div><br>"
."Статус: ".$order_detail['order_status']."<br>"
."Время доставки: ".$order_detail['delivery_date']." ".$order_detail['delivery_time']."<br>"
."Место доставки: ".$order_detail['delivery_point']."<br>"
."Состав заказа:<br>"
."<div style=\"border:1px solid black; padding-left:10px; margin:10px 10px 10px 0\">";
	foreach ($order_detail['dishes'] as $dish)
	{
		echo $dish['dish_name']." (".$dish['price'].") x".$dish['servings_number']."<br>";
	}
echo "</div>"
		."Сумма: ".$order_detail['total_price'];
?>
</div>