<div align="center">

<style>
td,table 
{
	border:1px solid black;
	
}
</style>

<table  style = "background: #A0522D">
  <tr style = "border: 1px solid black">
    <th>Название</th>
    <th>Ингридиенты</th>
    <th>Порции</th>
    <th>Тип</th>
    <th>Категория</th>
    <th> </th>
  </tr>
 
<?php
foreach ($reestr as $key=>$value)
{
	echo "<tr>";
	echo "<td>".$value['dish_name']."</td>"; 
	echo "<td>";
    foreach ($value['ingredients'] as $key1=>$value1)
	{
	 	echo $value1['product_name']."<br>";
	}		
	echo "</td>";
	echo "<td>";
	foreach ($value['portions'] as $key1=>$value1)
	{
		echo $value1['type_name']."<br>";
	}
	echo "</td>";
	echo "<td>".$value['type']."</td>";
	echo "<td>".$value['category']."</td>";
	
	echo "<td><a onclick=\"return confirm('?')\"  href=\"http://".$_SERVER['HTTP_HOST']."/reestr/delete/".$value['dish_id']."\"><button>Удалить</button></a></td><td><a href=\"http://".$_SERVER['HTTP_HOST']."/reestr/edit/".$value['dish_id']."\"><button>Изменить</button></a></td></tr>";
	echo "</tr>";
}

?>

</table>
<a href="<?php echo "http://".$_SERVER['HTTP_HOST']."/reestr/add"; ?>"><button >Добавить</button></a> 
</div>