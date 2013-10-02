<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title><?php echo $title;?></title>
	</head>
	
	<body>
		<div id = "UserInfo"><?php //echo $user;?></div>
		<div id = "Content">
			<form action = "../order/makeorder" method = "POST">
				<table style="border:1px solid black">
					<?php 
					try{
						include($menu);
					}
					catch(Exception $e){die('такого меню не существует');}
					for($i = 0;$i < count($menu_items);$i++)
					{
						echo "<tr><td>".$menu_items[$i]['name']."</td><td>".$menu_items[$i]['price']."</td><td><input type=\"text\" name=\"order[".$menu_items[$i]['name']."]\"><input type=\"hidden\" name=\"order_price[".$menu_items[$i]['name']."]\" value=".$menu_items[$i]['price']."></td></tr>";
						
					}
					echo "<input type=\"hidden\" name=\"menu_date\" value=\"".$title."\">";
					?>
				</table>
				<input type = "submit" Value="Оформить заказ" name = "smbt">
			</form>
		</div>
	</body>
</html>

