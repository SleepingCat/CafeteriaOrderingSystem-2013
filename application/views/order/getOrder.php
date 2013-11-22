<form action="/EquipOrder/equipOrGetContent" method="POST">
	<div align = "center"> Комплектуется заказ №: <?php echo $orderID ?> </div> <br>
	  <?php $i = 0; 
	  	if ($owner != null)
	  	{
	  		echo "Получатель: ".$owner[$i]['Buyer']."<br>";
	  						echo "Находится в строении: ".$owner[$i]['building'].
	  				  						", этаж: ".$owner[$i]['floor'].
	  				  						 ", оффис №: ".$owner[$i]['office']."<br><br>";
	  	 }?>
	  <table align = "center"><tr><td><input type = "submit" name = "showOrder" value = "Просмотреть заказ"></td>
	  <td><input type = "submit" name = "equip" value = "Укомплектовать"></td>
	  <td><input type = "submit" name = "cancel" value = "Отмена"></td></tr></table>
</form>