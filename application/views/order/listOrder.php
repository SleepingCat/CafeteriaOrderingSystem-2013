<form>
	<div align = "center"> Комплектуется заказ №: <?php echo $orderID ?> </div> <br>
	  <?php $i = 0; 
	  	if ($owner != null)
	  	{
	  		"<div align = "."center".">";
	  		echo "Получатель: ".$owner[$i]['Buyer']."<br>";
	  						echo "Находится в строении: ".$owner[$i]['building'].
	  				  						", этаж: ".$owner[$i]['floor'].
	  				  						 ", оффис №: ".$owner[$i]['office']."</div>";
	  	} 
	  	else {echo "Заказ отсутствует!";}
	  	?>		
</form>