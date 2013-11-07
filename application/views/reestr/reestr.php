<!-- @autor=MrAnderson -->

<div align="center">

<table class = "Datatable">
  <tr>
    <th class = "Datacell TabHeader">Название</th>
    <th class = "Datacell TabHeader">Ингридиенты</th>
    <th class = "Datacell TabHeader">Статус</th>
    <th class = "Datacell TabHeader">Тип</th>
    <th class = "Datacell TabHeader">Категория</th>
    <th class = "Datacell TabHeader">Является <br> стандартным</th>
    <th class = "Datacell TabHeader"> </th>
    <th class = "Datacell TabHeader"> </th>
  </tr>
 
<?php
foreach ($reestr as $key=>$value)
{
	echo "<tr>";
	echo "<td  class = \"Datacell\">".$value['dish_name']."</td>"; 
	
	echo "<td  class = \"Datacell\">";

    foreach ($value['ingredients'] as $key1=>$value1)
	{
	 	echo $value1['product_name']."<br>";
	}		
	
	echo "</td>";
	
	if ($value['is_available'] == '1')
	{
	echo "<td class = \"Datacell\"> Доступно <br> для заказа</td>";
	}
	else 
	{
		echo "<td class = \"Datacell\"> Не доступно <br> для заказа </td>";
	}
		
	echo "<td class = \"Datacell\">".$value['type']."</td>";
	echo "<td class = \"Datacell\">".$value['category']."</td>";
	
	if($value['is_standart'] == 1)
	{
	echo "<td class = \"Datacell\"> Да </td>";
	}
	else 
	{
		echo "<td class = \"Datacell\"> Нет </td>";
	}	
	echo "<td class = \"Datacell\"><a onclick=\"return confirm('?')\"  href=\"http://".$_SERVER['HTTP_HOST']."/reestr/delete/".$value['dish_id']."\"><button>Удалить</button></a></td>
    	  <td class = \"Datacell\"><a href=\"http://".$_SERVER['HTTP_HOST']."/reestr/edit/".$value['dish_id']."\"><button>Изменить</button></a></td></tr>";
	echo "</tr>";
}

?>

</table>
<a href="<?php echo "http://".$_SERVER['HTTP_HOST']."/reestr/add"; ?>"><button >Добавить</button></a> 
</div>