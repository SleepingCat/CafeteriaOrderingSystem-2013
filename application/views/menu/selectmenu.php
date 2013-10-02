<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title><?php echo $title;?></title>
	</head>
	
	<body>
		<div id = "UserInfo"><?php //echo $user;?></div>
		<div id = "Content">
			<form action = "menu/menuselect" method = "POST">
				<select name="menu">
					<option>Меню1(19.03.2013)</option>
					<option>Меню2(30.09.2014)</option>
				</select>
				<input type = "submit" value="OK" name = "smbt1">
			</form>
		</div>
	</body>
</html>

