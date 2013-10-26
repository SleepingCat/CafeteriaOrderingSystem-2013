<form>
	<div align = "center"> На данный момент комплектуются заказы для интервала: </div> 
		<?php echo $startTime ?> </h1> <br>
			Всего заказов на интервал:
				<?php echo $nowOrders[0]["delivery_limit"] ?>
					<div align = "center"> 
		    Осталось укомплектовать:
			     <?php echo $nowOrders[0]['COUNT'] ?></div><br>
		<div align = "center"><input type = "submit" name = "getOrder" value = "Получить заказ для комплектования"></div><br>
	<div align = "center"><input type = "submit" name = "showOrder" value = "Просмотреть заказ"></div>
</form>