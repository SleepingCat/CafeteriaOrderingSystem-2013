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
		<table align = "center"><td><input type = "submit" name = "getOrder" value = "Получить заказ" onclick = "this.form.clickedelm.value=this.value"></td>
								<td>   </td>
								<td><input type = "submit" name = "showLastEquip" value = "Просмотреть укомплектованные заказы"</td>
		</table><?php 
	} 
	
	else {echo "<div align = "."center"."> Заказы отсутствуют!</div><br>";}
	?>
</form>