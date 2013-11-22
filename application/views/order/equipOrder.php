<form action="/EquipOrder/equipOrGetContent" method="POST">
	<?php if ($startTime != null)
	{
		?> <div align = "center"> На данный момент комплектуются заказы для интервала: </div> 
			<?php echo $startTime ?> </h1> <br>
				Всего заказов на интервал:
					<?php echo $nowOrders?>
						<div align = "center"> 
			    Осталось укомплектовать:
				     <?php echo $leftOrders?></div><br>
		<table align = "center"><tr><td><input type = "submit" name = "print" value = "Распечатать данные заказа"></td>
								<td>   </td>
								<td><input type = "submit" name = "getOrder" value = "Получить заказ"></td>
								<td>   </td>
								<td><input type = "submit" name = "showLastEquip" value = "Просмотреть укомплектованные заказы"</td></tr>
		</table><?php 
	} 
	
	else {echo "<div align = "."center"."> Заказы отсутствуют!</div><br>";}
	?>
</form>