<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title><?php echo $title;?></title>
	</head>
	
	<body>
		<div id = "UserInfo"><?php //echo $user;?></div>
		<div id = "Content">
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
		</div>
	</body>
</html>

