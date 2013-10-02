<?php if(!isset($order)){die('Ничего не заказано');}
echo "Ваш заказ </br>";
	foreach($order as $key => $value) {echo $key." x".$value."<br>";}
	echo "На сумму: ".$summ." рублей"
	."<br>На ".$d_date
	."<br>Доставить(время) ".$d_time
	."<br>В путнкт ".$place
?>
<H2>Принято к исполнению</H2>
