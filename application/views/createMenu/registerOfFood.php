<form action = "../OnCreate" method = "POST">
    Список блюд <br>
	<table style="border:1px solid black">
		<?php 
		try{
			include($regOfFood);
		}
		catch(Exception $e){die('Такое меню уже есть');}
		for($i = 0;$i < count($registr_items);$i++)
		{
			echo  "<tr> 
				      <td>".$registr_items[$i]['name']."</td>
				      <br>
				      <td>Ингридиенты:</td>
				      <td>".$registr_items[$i]['ingrOne']."</td>
				      		<td>,</td>
				      <td>".$registr_items[$i]['ingrTwo']."</td>
				      		<td>,</td>
				      <td>".$registr_items[$i]['ingrThree']."</td>
				      		<td>.</td>		
				      <td>Цена:</td>
				      <td>".$registr_items[$i]['price']."</td>
					  <td>
					     <input type=\"checkbox\" name=\"order[".$registr_items[$i]['name']."]\">
				         <input type=\"hidden\" name=\"order_price[".$registr_items[$i]['name']."]\" value=".$registr_items[$i]['price'].">
				      </td>
				  </tr>";
			
		}
		echo "<input type=\"hidden\" name=\"menu_date\" value=\"".$title."\">";
		?>
	</table>
	<input type = "submit" Value="Создать меню" name = "smbt">
</form>
