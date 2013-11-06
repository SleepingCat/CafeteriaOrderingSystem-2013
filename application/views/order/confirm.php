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
		echo $value['dish_name']."(".$value['price'].") x".$value['servings_number']."<br>";
		$summ += $value['price']*$value['servings_number'];
	}
	echo "Итого: ".$summ."<br>";
	echo "Выберите форму заказа:<br>";
	
	echo "<select name = \"delivery_point\">
		<option value=\"none\">
			Без доставки
		</option>";


if (isset($delivery_point))
{
	echo '<option value="'.$delivery_point.'">';
	echo	$delivery_point;
	echo '</option>';
}
?>
</select><br>
<div id="delivery_time">
	Выберите время доставки:<br>
	<select name = "delivery_time">
	<?php 
	foreach ($options as $key => $value)
	{
		echo "<option value=\"$key\">".$value['delivery_time']."</option>";
	}
	?>
	</select><br>
</div>
<input type = "submit" class="btn_submit" value = "Подтвердить заказ" name="btn_confirm">
</form>
</div>