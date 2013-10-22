<script type="text/javascript">
function show_time(bla)
{
	document.getElementById('delivery_time').style.visibility = (bla == 1) ? 'visible':'hidden';
}
</script>
<style>
#delivery_time{visibility: hidden;}
</style>
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
?>
Выберите форму заказа:<br>
<select name = "type_payment" onchange="show_time(this.options[this.selectedIndex].index)">
	<option value="1">
		Без доставки
	</option>
<?php 
if (isset($user['Dislocation']) && !empty($user['Dislocation']))
{
	echo '<option value="2">';
	echo	'С доставкой';
	echo '</option>';
}
?>
</select><br>
<div id="delivery_time">
	Выберите время доставки:<br>
	<input type = "time" name = "delivery_time">
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