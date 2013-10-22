<div>
	Ваши заказы:<br>
<table>
	<?php
/**
 * Вывод ВСЕХ заказов пользователя без возможности редактирования 
 * с возможностью отменить заказ, если тот не в комплектовании
 */

	$summ = 0;
	foreach ($orders as $key => $value)
	{
		echo "<tr><td>".$value['order_id']."</td><td>".$value['order_date']."</td>
				<td>".$value['order_date']."</td>
			<td><a href=\"http://".$_SERVER['HTTP_HOST']."/order/cancel/".$value['order_id']."\">Отменить</a></td><td><a href=#>Изменить</a></td></tr>";
	}
?>
</table>
</div>