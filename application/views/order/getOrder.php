<form action="/EquipOrder/equipOrGetContent" method="POST">
	<div align = "center"> Комплектуется заказ №: <?php echo $orderID ?> </div>
	<div align = "center"> На интервал: <?php echo $period ?> </div><br>
	  <?php $i = 0; 
	  	if ($owner != null)
	  	{
	  		echo "Получатель: ".$owner[$i]['Buyer']."<br>";
	  						echo "Находится в строении: ".$owner[$i]['building'].
	  				  						", этаж: ".$owner[$i]['floor'].
	  				  						 ", оффис №: ".$owner[$i]['office']."<br><br>";?>
	  				  						 
	  		<div align = "center"> Заказ содержит: </div><br>
	  		<div align = "center"><table border = solid 1px black bgcolor = #A0522D> <tr> <td> Блюдо </td><td> Количество </td><td> Цена </td></tr>
	  		<?php
		  		foreach ($owner as $key => $value)
		  		{
		  			echo "<tr><td>".$value['dish_name']."</td><td>".$value['servings_number']."</td><td>".$value['price']."</td></tr>";
		  		}
		  	?>
	  		</table></div><br> 
	  			  <table align = "center">
	  		<td><input type = "submit" name = "equip" value = "Укомплектовать"></td> <td>   </td>
	  		<td><input type = "submit" name = "cancel" value = "Отмена"></td></tr></table>
	  <?php
	  		
	  	 }
	  	 else {echo "<div align = "."center"."> Заказ пуст!</div><br>"; ?>
				<div align = "center"> <input type = "submit" name = "equip" value = "Назад"></div><?php
	  		 } ?>
</form>