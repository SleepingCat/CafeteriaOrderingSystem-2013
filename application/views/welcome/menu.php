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
<tr><td>Наименование</td><td>Цена(руб.)</td></tr>
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
			echo "<tr>
 					<td>".$value['dish_name']."</td>

					<td>".$value['portions'][2]['price']."</td>
				</tr>";
		}
	?>
</table>
</div>