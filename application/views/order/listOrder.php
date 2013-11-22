<form action="/EquipOrder/index" method="POST">
  <title>Список блюд в заказе</title>
	<div align = "center"> Комплектуется заказ №: <?php echo $orderID ?> </div> <br>
	  <?php $i = 0; 
	  	if ($owner != null)
	  	{
	  		echo "Получатель: ".$owner[$i]['Buyer']."<br>";
	  						echo "Находится в строении: ".$owner[$i]['building'].
	  				  						", этаж: ".$owner[$i]['floor'].
	  				  						 ", оффис №: ".$owner[$i]['office']."<br><br>" ?> 
	  		
	  		<div align = "center"> Заказ содержит: </div><br>
	  		<div align = "center"><table border = solid 1px black bgcolor = #A0522D> <tr> <td> Блюдо </td><td> Количество </td><td> Цена </td></tr>
	  		<?php
		  		foreach ($owner as $key => $value)
		  		{
		  			echo "<tr><td>".$value['dish_name']."</td><td>".$value['servings_number']."</td><td>".$value['price']."</td></tr>";
		  		}
		  	?>
	  		</table></div><br> 
	  		<label>Для печати нажмите Ctrl+P</label>
	  		<div align = "center"> <input type = "submit" name = "equip" value = "Назад"></div>
	  		<?php
	  	} 
	  	
	  	else {echo "<div align = "."center"."> Заказ пуст!</div><br>"; ?>
				<div align = "center"> <input type = "submit" name = "equip" value = "Назад"></div><?php
	  		 }
	  	?>  
</form>