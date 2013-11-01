<style>
td,table 
{
	border:1px solid black;
}
</style>
<div>
	Ваши заказы:<br>
<table>
<tr><td>Номер заказа</td><td>Дата заказа</td><td>Время заказа</td><td>Статус заказа</td></tr>
	<?php
/**
 * Вывод ВСЕХ заказов пользователя без возможности редактирования 
 * с возможностью отменить заказ, если тот не в комплектовании
 */
	$summ = 0;
	foreach ($orders as $key => $value)
	{
		echo "<tr><td>".$value['order_id']."</td><td>".$value['delivery_date']."</td>
			<td>".$value['delivery_time']."</td><td>".$value['order_status']."</td>
			<td><a class=\"btn_submit[".$key."]\" href=http://".$_SERVER['HTTP_HOST']."/order/detail/".$key."><button>Подробнее</button></a></td></td></tr>";
			//<td><a href=\"http://".$_SERVER['HTTP_HOST']."/order/cancel/".$value['order_id']."\"><button>Отменить</button></a></td><td><a href=#><button>Изменить</button></a></td></tr>";
	}
?>
</table>
</div>