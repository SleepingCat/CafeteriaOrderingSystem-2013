<?php 
/**
 * тут вывод меню за конкретную дату
 */
?>
<style>
	table,td{border: 1px solid black}
</style>
<?php
if (isset($error_code) && $error_code > 0)
{
	echo $error_code;
} 
?>
	<div style="float: left; position: relative;">
	<table>
	<tr><td>Наименование</td><td>Цена(руб.)</td><td>Заказать</td></tr>
	<?php
		$type = "none";
		foreach ($menu as $key => $value)
		{
			if ($type != $value['type'])
			{
				$type=$value['type'];
				echo "<tr><td colspan=\"5\">$type</td></tr>";
			}
			echo "<tr><form action=\"./add_to_cart\" method=\"post\">
 					<td>".$value['dish_name']."</td>
					<td>".$value['price']."</td>
					<td><input type=\"number\" name=cart[".$key."] value=1></td>
					<td><input type=\"submit\" name=\"smbt_make_order\" value=\"Заказать\"></td>
				</form></tr>";
		}
	?>
	</table>
	</div>
	<div style="margin-left:50px;float: left;;">
	<?php 
		echo View::factory('order/cart');
	?>
	</div>