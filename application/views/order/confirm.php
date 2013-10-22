<script type="text/javascript">
function show_time(bla)
{
	document.getElementById('delivery_time').style.visibility = (bla == 1) ? 'visible':'hidden';
}
</script>

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
		echo $value['dish_name']."(".$value['price'].") x".$value['amount']."<br>";
		$summ += $value['price']*$value['amount'];
	}
	echo "Итого: ".$summ."<br>";
	
	// заглушка для данных пользователя
	// TODO: заменить на 
	// $user = Auth::instance()->get_user()->as_array();
	//<select name = "type_payment" onchange="show_time(this.options[this.selectedIndex].index)">
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
<input type = "submit" value = "Подтвердить заказ" name="btn_confirm">
</form>
</div>