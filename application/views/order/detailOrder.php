<style>
	table
	{
		border:1px solid black;
		background:#cd853f;
	}
	td
	{
		border:1px solid black;
		padding:0px 7px;
	}
</style>
<form action="/EquipOrder/equipOrGetContent" method="POST">
	<div align = "center"> Заказ №: <?php echo $order ?>  Статус заказа: <?php echo $status ?> </div>
		<div align = "center"> Дата доставки: <?php echo $date ?>  Период комплектовки заказа: <?php echo $period ?></div><br>
			<div align = "center"> Получатель: <?php echo $owner ?> </div>
				<div align = "center"> Находится в строении <?php echo $build ?>  этаж: <?php echo $floor ?> оффис №: <?php echo $office ?> </div><br>
					<div align = "center"> Заказ содержит: </div>
					  	<div align = "center"><table><tr><td> Блюдо </td><td> Количество </td><td> Цена </td></tr>
					  	<?php
						  	foreach ($ex as $key => $value)
						  	{
						  		echo "<tr><td>".$value['dish_name']."</td><td>".$value['servings_number']."</td><td>".$value['price']."</td></tr>";
						  	}
						?>
			  		</table></div>
		<div align = "center"><input type = "submit" name = "cancel" value = "Вернуться к комплектовке заказов"> </div>
		<div align = "center"><input type = "submit" name = "back" value = "Назад"></div>
		
</form>