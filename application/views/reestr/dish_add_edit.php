<form action = "add" method= POST>

<div>

<h1>Добавить блюдо:</h1>
<p> Название: <input type="text" name="title"></p>
<p> Категория: 
<select name = "category">
<?php
foreach ($categories as $key => $value) 
{
	echo "<option value=\"".$key."\">".$value['name']."</option>";
}
?>
</select>
</p>
<p> Тип: 
<select name = "type">
<?php
foreach ($types as $key => $value) 
{
	echo "<option value=\"".$key."\">".$value['name']."</option>";
}
?>
</select>
</p>

<div class = "ingridients">
<p> Ингредиенты: </p>

</div>
<div>

<select name = "ingredient">
<?php
foreach ($ingredient as $key => $value) 
{
	echo "<option value=\"".$key."\">".$value['product_name']."</option>";
}

?>
</select>
<input type="number" name = "ingr_weigth">

<a href=#> <button id ="delete"> - </button></a>


<br>

<script type="text/javascript">

$('#add a').live('click',function(){

	var html_inputs = '<div class="ogranichenie"> <select name = "ingredient">';

	<?php
	foreach ($ingredient as $key => $value)
		{
			 echo "html_inputs += \"<option value=".$key.">".$value['product_name']."</option>\";\n";
		}	
	?>
	
	html_inputs+='</select> <input type="number" name = "ingr_weigth">	<a href=#"> <button id = "delete"> - </button></a></div>';
	$('.ingridients').append(html_inputs);
	$('.ingridients .ogranichenie:hidden').slideDown(200);

		
	return false;
});

</script>

<div id="add">
<a href=#"> <button> + </button></a>
</div>

</div>
<input type = "submit" name = "btn_dish_add" value = "Принять" >
<a  href= "<?php echo "http://".$_SERVER['HTTP_HOST']."/reestr/"; ?>" ><button>Отмена</button></a> 
</div>

</form>
