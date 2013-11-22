<!-- @autor=MrAnderson -->

<script type="text/javascript">
$(document).ready(function(){
	var k=$("div .ogranichenie").size();
	$('#add a').live('click',function(){
		
		var html_inputs = '<div class="ogranichenie"> <select name = \"ingredients['+ k +'][ingredient_id]\">';
	
		<?php
		foreach ($ingredient as $key => $value)
			{
				 echo "html_inputs += \"<option value=".$key.">".$value['product_name']."</option>\";\n";
			}	
		?>
		
		html_inputs+='</select> <input type="number" name = \"ingredients['+ k++ +'][yield]\">	<a class = "delete" href=#"> <button> - </button></a></div>';
		$('.ingridients').append(html_inputs);
		$('.ingridients .ogranichenie:hidden').slideDown(200);
	
		Height_Add();	
		return false;
	});
	
	$('.delete').live('click',function(){
		
		$(this).parent().remove();
		--k;
		return false;
	});
});
</script>


<form action = "" method= POST>

<div>
<h1>Добавить блюдо:</h1>
<p> Название: 
<?php 
		if (isset ($dish))
		{
			echo "<input type = \"text\" name=\"title\" value =\"".$dish['dish_name']."\">";
		}
		
		else 
		{
			echo "<input type=\"text\" name=\"title\">";
		}

?>
</p>
<p> Категория: 
<select name = "category" >
<?php

if(isset($dish))
{
	foreach ($categories as $key => $value)
	{
		if($value['name'] == $dish['category'])
		{
			echo "<option selected value=\"".$key."\" selected = \"selected\">".$value['name']."</option>";
		}
		else 
		{
			echo "<option value=\"".$key."\">".$value['name']."</option>";
		}
	}
}
else 
{
	foreach ($categories as $key => $value) 
	{
		echo "<option value=\"".$key."\">".$value['name']."</option>";
	}
}
?>
</select>
</p>
<p> Тип: 
<select name = "type">
<?php
foreach ($types as $key => $value) 
{	
	if (isset ($dish))
	{
	   if ($value['name'] === $dish['type'])
		{
			echo "<option  value=\"".$key."\" selected = \"selected\">".$value['name']."</option>";
		}

		else
		{
			echo "<option value=\"".$key."\">".$value['name']."</option>";
		}
	}
	
	else 
	{
		echo "<option value=\"".$key."\">".$value['name']."</option>";
		
	}
		
	
}
?>
</select>
</p>
<p>
<?php
if (isset ($dish))
{
	if($dish['is_standart']!=null)
	{
		echo "Является стандартным: <input id=\"chek_standart\" type=\"checkbox\" name=\"standart\" checked=\"checked\"/>";
		
	}
	else 
	{
		echo "Является стандартным: <input id=\"chek_standart\" type=\"checkbox\" name=\"standart\"/>";
	}
}
else 
{
	echo "Является стандартным: <input id=\"chek_standart\" type=\"checkbox\" name=\"standart\"/>";
}
?>
</p>

<p>
<?php
if (isset ($dish))
{
	if($dish['is_available']!=null)
	{
		echo "Доступно для заказа: <input id=\"chek_available\" type=\"checkbox\" name=\"available\" checked=\"checked\"/>";
		
	}
	else 
	{
		echo "Доступно для заказа: <input id=\"chek_available\" type=\"checkbox\" name=\"available\"/>";
	}
}
else 
{
	echo "Доступно для заказа: <input id=\"chek_available\" type=\"checkbox\" name=\"available\"/>";
}
?>
</p>

<div class = "ingridients">
<p> Ингредиенты: </p>

<?php
$counter = 0; 
 if(isset($dish['ingredients']))
 {
 	foreach ($dish['ingredients'] as $key =>$value)
 	{
 		echo "<div  class=\"ogranichenie\"> <select name = \"ingredients['$counter'][ingredient_id]\">";
 		
 		foreach ($ingredient as $key1 => $value1)
		{
			if($key == $key1)
			{

				echo "<option value=".$key1." selected = \"selected\">".$value1['product_name']."</option>\";\n";
			
			}
			else 
			{
				echo "<option value=".$key1.">".$value1['product_name']."</option>\";\n";
			}
			
		}
		
		echo "</select> <input type=\"number\" name = \"ingredients['$counter'][yield]\" value = \"".$value['yield']."\">	<a href=#\"> <button id = \"delete\"> - </button></a></div>";
		$counter++;
	}
 }
?>
</div>


<div id="add">
<a href=#> <button> + </button></a>
</div>


<input type = "submit" name = "btn_dish_add" value = "Принять" >
<a  href= "<?php echo "http://".$_SERVER['HTTP_HOST']."/reestr/"; ?>" ><button>Отмена</button></a> 
</div>

</form>
