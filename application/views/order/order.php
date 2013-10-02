<form action = "index" method = "POST">
	Ваш заказ </br>
	
	<?php 
		foreach($order as $key => $value){ echo $key." x".$value."<br>";}
		echo "На сумму: ".$summ." рублей"
		."<br>На <input name=\"date\" type=\"text\" value=".substr($menu_date,9).">"
		."<br>Доставить в <input type=\"text\" name=\"time\">"
		."<br>В путнкт <input type=\"text\" name=\"place\">"
	?>
	<input type = "submit" Value="Сохранить" name = "sbmt2">

</form>
<a href="cancelorder"><button>Отменить заказ</button></a> 
