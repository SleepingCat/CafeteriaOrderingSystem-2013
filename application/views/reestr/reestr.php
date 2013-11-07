<div align="center">
<!--  
<style>
td,table 
{
	margin-top: 35px;	
	text-align: left;
	border-collapse: collapse;
	color: #F5D694;	
	
}
</style>
-->

<table class = "Datatable">
  <tr>
    <th class = "Datacell TabHeader">Название</th>
    <th class = "Datacell TabHeader">Ингридиенты</th>
    <th class = "Datacell TabHeader">Порции</th>
    <th class = "Datacell TabHeader">Тип</th>
    <th class = "Datacell TabHeader">Категория</th>
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
	echo "<td class = \"Datacell\">";
	foreach ($value['portions'] as $key1=>$value1)
	{
		echo $value1['type_name']."<br>";
	}
	echo "</td>";
	echo "<td class = \"Datacell\">".$value['type']."</td>";
	echo "<td class = \"Datacell\">".$value['category']."</td>";
	
	echo "<td class = \"Datacell\"><a onclick=\"return confirm('?')\"  href=\"http://".$_SERVER['HTTP_HOST']."/reestr/delete/".$value['dish_id']."\"><button>Удалить</button></a></td>
    	  <td class = \"Datacell\"><a href=\"http://".$_SERVER['HTTP_HOST']."/reestr/edit/".$value['dish_id']."\"><button>Изменить</button></a></td></tr>";
	echo "</tr>";
}

?>

</table>
<a href="<?php echo "http://".$_SERVER['HTTP_HOST']."/reestr/add"; ?>"><button >Добавить</button></a> 
</div>