<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title><?php echo $title;?></title>
	</head>
	
	<body>
		<div id = "UserInfo"><?php //echo $user;?></div>
		<div id = "Content">
				
				
				<?php if(!isset($order)){die('Ничего не заказано');}
				echo "Ваш заказ </br>";
					foreach($order as $key => $value) {echo $key." x".$value."<br>";}
					echo "На сумму: ".$summ." рублей"
					."<br>На ".$d_date
					."<br>Доставить(время) ".$d_time
					."<br>В путнкт ".$place
				?>
				<H2>Принято к исполнению</H2>
		</div>
	</body>
</html>

