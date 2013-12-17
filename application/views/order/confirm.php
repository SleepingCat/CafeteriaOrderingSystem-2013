<?php
	if(isset($error_code) && $error_code != 0)
	{
		switch ($error_code)
		{
			case 1: echo "Ошибка записи в БД";
			case 2: echo "Превышен лимит доставки на данное время";
		}
	} 
?>
<div>
	Ваш заказ:<br>
<form action="" method="post">
<?php
	/*
	 * Вывод заказа без возможности редактирования 
	 * с возможностью указать время доставки
	 */
	$summ = 0;
	foreach ($_SESSION['order'] as $key => $value)
	{
		echo $value['dish_name']."(".$value['portions'][$value['portion']]['type_name'].") ".$value['portions'][$value['portion']]['price']."x".$value['servings_number']."<br>";
		$summ += $value['portions'][$value['portion']]['price']*$value['servings_number'];
	}
	echo "Итого: ".$summ."<br>";
	echo "Выберите форму заказа:<br>";
	echo "<select name = \"delivery_point\">";
	$u = Auth::instance()->get_user()->as_array();
	if($u['payment_type'] == 0)
	{
		echo "<option value=\"none\">Без доставки</option>";
	}
	else 
	{
		if (isset($delivery_point))
		{
			echo '<option value="'.$delivery_point.'">';
			echo	$delivery_point;
			echo '</option>';
		}
	}
	echo "</select>";
?>
<br>
<div id="delivery_time">
	Выберите время доставки:<br>
	<select name = "delivery_time">
	<?php 

	foreach ($options as $key => $value)
	{
		if(date("Y-m-d") == $_SESSION['mk_order_menu_date'])
		{
			if(strtotime($value['delivery_time']) >= time()){
				echo "<option value=\"$key\">".$value['delivery_time']."</option>";
			}
		}
		else 
		{
			echo "<option value=\"$key\">".$value['delivery_time']."</option>";
		}
	}
	?>
	</select><br>
</div>
<input type = "submit" class="btn_submit" value = "Подтвердить заказ" name="btn_confirm">
</form>
</div>