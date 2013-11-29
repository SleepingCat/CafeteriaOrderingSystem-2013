<style>
	.menu_table {border-collapse:separate;border-spacing:1px;}
	table,td {border:1px solid black;}
</style>

<?php
if (isset($error_code) && $error_code > 0)
{
	echo "В меню пусто...";return;
} 
?>
<div align=center>
<H1>Меню на (<?php echo $_SESSION['mk_order_menu_date']; ?>):</H1>
<table class = "menu_table">
<tr><td>Наименование</td><td>Размер порции</td><td>Цена(руб.)</td></tr>
	<?php
		$type = "none";
		$session = Session::instance();
		foreach ($menu as $key => $value)
		{
			if ($type != $value['type'])
			{
				$type=$value['type'];
				echo "<tr><td colspan=\"5\">$type</td></tr>";
			}
			echo "<tr><form id=\"add_form".$key."\" action=\"./add_to_cart\" method=\"post\">
 					<td>".$value['dish_name']."</td>
					<td><select name=\"portion\">";
					$price = null;
					foreach ($value['portions'] as $portion_id => $portion_value)
					{
						echo "<option value=\"".$portion_id."\">".$portion_value['type_name']."</option>";
						$price .= $price?"\\".$portion_value['price']:$portion_value['price'];
					}
					echo "</select>
					</td>
					<td>".$price."</td>
				</tr>";
		}
	?>
</table>
</div>