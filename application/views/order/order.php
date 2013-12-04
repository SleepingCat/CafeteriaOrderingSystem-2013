<?php defined('SYSPATH') or die('No direct script access.');?>

<script>
$(document).ready(function(e)
{
	$("td").mouseenter(function(e)
	{        
		$(this).parent("tr").css("background-color", "rgba(155,155,155,0.5);");		
    });
    
	$("td").mouseleave(function(e) 
	{
        $(this).parent("tr").css("background-color", "transparent");		
    });

	$( "tr" ).tooltip(
	{
		content: function() 
		{	        
			var t = $(this).attr("title");			
			return "Перейти к заказу " + t;			
	    },
	    tooltipClass: "OrderTooltip",
	    track: true
	});		
});
</script>

<div class="PageHeader">Ваши заказы</div>

<table class="DataTable" style="width: 600px; margin: 0px 80px; cursor: default;">
<tr>
	<th class="DataCell DataTableHeader ColoredRow">Номер заказа</th>
    <th class="DataCell DataTableHeader ColoredRow">Дата заказа</th>
    <th class="DataCell DataTableHeader ColoredRow">Время заказа</th>
    <th class="DataCell DataTableHeader ColoredRow">Статус заказа</th>
</tr>

<?php foreach ($orders as $key => $value) 
{?>
<tr title="<? echo $key ?>" class="<? echo "btn_submit[".$key."]" ?>" onClick="window.location.href='http://<?echo $_SERVER['HTTP_HOST']?>/order/detail/<? echo $key?>'">	
	<td class="DataCell" style="text-align: center;">
		<? echo $value['order_id'] ?>
	</td>
    <td class="DataCell" style="text-align: center;">
    	<? echo DateTime::createFromFormat("Y-m-d", $value['delivery_date'])->format("d.m.Y") ?>
    </td>
    <td class="DataCell" style="text-align: center;">
    	<? echo DateTime::createFromFormat("G:i:s", $value['delivery_time'])->format("G:i") ?>
    </td>
    <td class="DataCell" style="text-align: center;">
    	<? echo $value['order_status'] ?>
    </td>    
</tr>
<? }; ?>
</table>

<?php //<td><a href=\"http://".$_SERVER['HTTP_HOST']."/order/cancel/".$value['order_id']."\"><button>Отменить</button></a></td><td><a href=#><button>Изменить</button></a></td></tr>";?>
