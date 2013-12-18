<?php defined('SYSPATH') or die('No direct script access.');?>

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


<div class="PageHeader">
	<?php if (isset ($dish))
	{	
		echo "Редактирование блюда";	
	}
	else
	{
		echo "Создание блюда";
	}
	?>
</div>
<form class="ProfileForm" action = "" method= POST>
<?php 
if (isset ($dish))
{

	echo "<input type = \"hidden\" name = \"id\" value =\"".$dish['dish_id']."\">";

}?>
<div class="ProfileFormArea">

<fieldset class="ProfileFormFieldset" style="width: auto; text-align: left; margin: 5px 0px;">
	<legend style="cursor: default; text-align: center; font-weight: bold;">Данные блюда</legend>
<div class="TitledTextboxArea">
	<label for="username">Название:</label>
	<input type="text" class="ProfileTextBox" size="25" maxlength="60" name="title" value="<?php if (isset ($dish))
		{
			echo $dish['dish_name'];
		}?>"/>
</div>
<div class="TitledTextboxArea">
	<label for="username">Категория:</label>
	<select name = "category" class="CustSelect">
	<?php foreach ($categories as $key => $value)
	{?>
		<option value="<? echo $key ?>"
			<?php if (isset ($dish) && $value['name'] == $dish['category']) : ?> selected="selected" <?php endif ?>><? echo $value['name'] ?>
		</option>
	<?}?>	
	</select>
</div>
<div class="TitledTextboxArea">
	<label for="username">Тип:</label>
	<select name = "type" class="CustSelect">
	<?php foreach ($types as $key => $value)
	{?>
		<option value="<? echo $key ?>"
			<?php if (isset ($dish) && $value['name'] == $dish['type']) : ?> selected="selected" <?php endif ?>><? echo $value['name'] ?>
		</option>
	<?}?>		
	</select>
</div>
<div style="margin: 5px 0px;">
	<input type="checkbox" class="styled" name="standart" id="chek_standart"
		<?php if (isset ($dish) && $dish['is_standart']!=null) : ?> checked="checked" <?php endif ?>>
	<label for="chek_standart" style="text-indent: 5px; line-height: 25px;">	
		Является стандартным	
	</label><br>
	
	<input type="checkbox" class="styled" name="available" id="chek_available"
		<?php if (isset ($dish) && $dish['is_available']!=null) : ?> checked="checked" <?php endif ?>>
	<label for="chek_standart" style="text-indent: 5px; line-height: 25px;">	
		Доступно для заказа	
	</label><br>	
</div>
</fieldset>

<fieldset class="ProfileFormFieldset" style="width: auto; text-align: center; margin: 10px 0px;">
	<legend style="cursor: default; text-align: center; font-weight: bold;">Ингредиенты</legend>
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
<div id="add">
	<a href=#><button> + </button></a>
</div>
</fieldset>

<div class="FormBottomBorder">
	<input type="submit" class="FormBut" name="btn_dish_add"  id="input1" value="Принять" />
	<a  href= "<?php echo "http://".$_SERVER['HTTP_HOST']."/Reestr/"; ?>" class="FormBut">Отмена</a>    
</div>	

</div>
</form>



























<!--  
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
	   if ($value['name'] == $dish['type'])
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
-->