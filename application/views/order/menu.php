<style>
	table,td {border:1px solid black;
</style>
<?php
/*
echo "<pre>";
print_r($menu);
echo "</pre>";
*/
if (isset($error_code) && $error_code > 0)
{
	echo $error_code;
} 
?>
<div align=center>
<H1>Меню на (<?php echo $_SESSION['mk_order_menu_date']; ?>):</H1>
<table>
<tr><td>Наименование</td><td>Размер порции</td><td>Цена(руб.)</td><td>Заказать</td></tr>
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
					<td><select name=\"portion\">";
					$price = null;
					foreach ($value['portions'] as $portion_id => $portion_value)
					{
						echo "<option value=\"".$portion_id."\">".$portion_value['type_name']."</option>";
						$price .= $price?"\\".$portion_value['price']:$portion_value['price'];
					}
					echo "</select></td>
					<td>".$price."</td>
					<td><input type=\"number\" min=\"1\" max = \"50\" maxlength=\"2\" name=cart[".$key."] value=1></td>
					<td><input type=\"submit\" name=\"smbt_make_order\" id=\"btn_submit[".$key."]\" value=\"Заказать\"></td>
				</form></tr>";
		}
	?>
</table>
</div>
<?php 
	echo View::factory('order/cart');
?>