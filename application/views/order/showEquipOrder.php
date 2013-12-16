<style>
	table
	{
		border:1px solid black;
		background:#cd853f;
	}
	td
	{
		border:1px solid black;
		padding:0px 7px;
	}
</style>
<form action="/EquipOrder/equipOrGetContent" method="POST">
	<label align = "center"> Укомплектованные заказы: </label><br>
				<table align = "center"><tr><td> Заказ № </td><td> Интервал доставки </td><td> Дата доставки </td><td> Статус </td><td>Просмотреть</td></tr>
					<?php
						$i = 0;
						foreach ($list as $key => $value)
						{
						   echo "<tr>
								 <td align = \"center\">".$value['order_id']."</td>
								 <td align = \"center\">".$value['delivery_period']."</td>
								 <td align = \"center\">".$value['delivery_date']."</td>
								 <td align = \"center\">".$value['order_status']."</td>
								 <td align = \"center\"><input type = \"submit\" class = \"smb_order\" name = \"smb[".$i."]\" value = \"Детали\"</tr>";
						   $i++;
						}
					?>
				</table><br>
		<div align = "center"><input type = "submit" name = "cancel" value = "Назад"></div>
</form>