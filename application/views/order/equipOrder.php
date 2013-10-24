<form>
	<div align = "center"> На данный момент комплектуются заказы для интервала:> </div><br> 
		<input type = "text" name = "Time" Value = "<?php echo $startTime ?>"> </h1> <br>
			<label>Всего заказов на интервал:
				<input type = "text" name = "totalOrder" Value = "<?php echo $nowOrders ?>" size = 5></label> 
					<div align = "right"> 
				 <label>Осталось укомплектовать:
			<input type = "text" name = "balance" Value = "<?php $nowOrders ?>" size = 5></label></div><br>
		<div align = "center"><input type = "submit" name = "getOrder" value = "Получить заказ для комплектования"></div><br>
	<div align = "center"><input type = "submit" name = "showOrder" value = "Просмотреть заказ"></div>
</form>