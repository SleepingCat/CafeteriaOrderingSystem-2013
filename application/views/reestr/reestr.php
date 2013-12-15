<?php defined('SYSPATH') or die('No direct script access.');?>

<script>
$(document).ready(function(e)
{
	$("td").mouseenter(function(e)
	{        
		$(this).parent("tr").css("background-color", "rgba(100,100,100,0.5)");		
    });
    
	$("td").mouseleave(function(e) 
	{
        $(this).parent("tr").css("background-color", "transparent");		
    });

	/*$( "tr" ).tooltip(
	{
		content: function() 
		{					
			return "Редактировать блюдо";			
	    },
	    tooltipClass: "OrderTooltip",
	    track: true
	});*/

	$( "th" ).tooltip(
	{
		content: function() 
		{	
			return "Нажмите на заголовок, чтобы отсортировать колонку";			
		},
		tooltipClass: "OrderTooltip",
		track: true
	});	

	$("td").click(function(e)
	{		
		$("#DishName").text($(this).parent("tr").children("td:first").text());

		$("#dialog-ask").modal({
			overlayId: "dialog-overlay",			
			onOpen: function (dialog)
			{
				dialog.overlay.fadeIn(300);
				dialog.container.fadeIn(300);
				dialog.data.fadeIn(300);
			},
			onClose: function (dialog) 
			{
				dialog.overlay.fadeOut(300);
				dialog.container.fadeOut(300);
				dialog.data.fadeOut(300);
				$.modal.close();
			}
		});
		
		var rowID = $(this).parent("tr").attr("id");				
		$("#edDish").attr("href", "/reestr/update/"+rowID);
		$("#delDish").attr("href", "/reestr/delete/"+rowID);
		
		$("#cancelDish").click(function(e)
		{
			$.modal.close();			
		});				
	});					
});
</script>

<style>
.DataCell{
	text-align: center;
	font-size: 14px;
	cursor: default;
	vertical-align: middle;
}
</style>

<div class="DialogCloser" id="dialog-ask">
	<div id="DishName" style="display: block; margin-bottom: 10px;">		
	</div>
	<div>
		<a id="edDish" class="EntBut EntButLeft" style="border-radius: 10px;">
			<span>Изменить</span>
		</a>
		<a id="delDish" class="EntBut EntButRight" style="border-radius: 10px;">
			<span>Удалить</span>
		</a>
		<a id="cancelDish" class="EntBut EntButLeft" style="border-radius: 10px; text-shadow: 0 1px 0 rgba(0,0,0,0.4);">
			<span>Отмена</span>
		</a>	
	</div>
</div>

<div class="PageHeader">Реестр блюд</div>
<div align="left" style="margin: 5px 0px 20px 40px;">
	<a href="<?php echo "http://".$_SERVER['HTTP_HOST']."/reestr/add"?>" class="EntBut EntBut-color" style="width: 200px; line-height: 30px;">
    	<span>Добавить блюдо</span>
    </a>
</div>
<table class="DataTable" style="width: 720px;">
	<tr class="ColoredRow">
		<th class = "DataCell DataTableHeader" onclick="sort(this)" style="cursor: pointer;" title="">Название</th>
	    <th class = "DataCell DataTableHeader" onclick="sort(this)" style="cursor: pointer;" title="">Ингредиенты</th>
	    <th class = "DataCell DataTableHeader" onclick="sort(this)" style="cursor: pointer;" title="">Статус</th>
	    <th class = "DataCell DataTableHeader" onclick="sort(this)" style="cursor: pointer;" title="">Тип</th>
	    <th class = "DataCell DataTableHeader" onclick="sort(this)" style="cursor: pointer;" title="">Категория</th>
	    <th class = "DataCell DataTableHeader" onclick="sort(this)" style="cursor: pointer;" title="">Является <br>стандартным</th>	
	</tr>
	
<?php foreach ($reestr as $key=>$value)
{?>
	<tr title="" id=<?php echo $value['dish_id'] ?>>
		<td class="DataCell">
			<?php echo $value['dish_name'] ?>
		</td>
		<td class="DataCell" style="text-align: left; font-size: 14px; cursor: default;">
			<?php foreach ($value['ingredients'] as $key1=>$value1)
			{
			 	echo "- ".$value1['product_name']."<br>";
			}?>
		</td>
		<td class="DataCell">
			<?php if ($value['is_available'] == '1')
			{
				echo "Доступно<br>для заказа";
			}
			else 
			{
				echo "Не доступно<br>для заказа";
			}?>
		</td>
		<td class="DataCell">
			<?php echo $value['type'] ?>
		</td>
		<td class="DataCell">
			<?php echo $value['category'] ?>
		</td>
		<td class="DataCell">
			<?php if($value['is_standart'] == 1)
			{
				echo "Да";
			}
			else 
			{
				echo "Нет";
			}?>
		</td>				
	</tr>
<?}?>
	
</table>

<!-- 
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
    	  <td class = \"Datacell\"><a href=\"http://".$_SERVER['HTTP_HOST']."/reestr/update/".$value['dish_id']."\"><button>Изменить</button></a></td></tr>";
	echo "</tr>";
}

?>

</table>
<a href="<?php echo "http://".$_SERVER['HTTP_HOST']."/reestr/add"; ?>"><button >Добавить</button></a> 
</div> -->