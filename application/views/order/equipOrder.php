﻿<form action="/EquipOrder/equipOrGetContent" method="POST">
	<div align = "center"> На данный момент комплектуются заказы для интервала: </div> 
		<?php echo $startTime ?> </h1> <br>
			Всего заказов на интервал:
				<?php echo $nowOrders?>
					<div align = "center"> 
		    Осталось укомплектовать:
			     <?php echo $leftOrders?></div><br>
		<div align = "center"><input type = "submit" name = "getOrder" value = "Получить заказ для комплектования" onclick = "this.form.clickedelm.value=this.value"></div><br>
	<div align = "center"><input type = "submit" name = "showOrder" value = "Просмотреть заказ" onclick = "this.form.clickedelm.value=this.value"></div>
</form>