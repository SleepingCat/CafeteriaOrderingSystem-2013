<style>
	.menu_table {border-collapse:separate;border-spacing:1px;}
	table,td {border:1px solid black;}
</style>

<script >
$(document).ready(function(){
	$(".add_button1").click( function(){
		var data1 = '{ name: "John", time: "2pm" }';
		// data2 = $(".some_link").parent().find('input[name=A1]').val();
		data2 = $(".add_button").parent().serializeArray();
		$.post("/Handler/", data2, function(data){
		//$('body').append('<div>' + data + '</div>');
			alert(data);
		});
		return false;
	});
});
$('#cart').ready(function (){
	$.post("/Handler", function(data){
		$('#cart').html(data);
	});
});

function add_to_cart(id)
{
	var data2 = $('#add_form'+id).serializeArray();
	$.post("/Handler/add", data2, function(data){
		$('#cart').html(data);
		});
	return false;
}

function cart_clear(id)
{
	$.post("/Handler/clear", function(data){
		$('#cart').html(data);
		});
	return false;
}

function remove_from_cart(id)
{
	$.post("/Handler/remove/" + id, function(data){
		$('#cart').html(data);
		});
	return false;
}
</script>
<?php
/*
echo "<pre>";
print_r($menu);
echo "</pre>";
*/
if (isset($error_code) && $error_code > 0)
{
	echo $error_code;
} 
?>
<div align=center>
<H1>Меню на (<?php echo $_SESSION['mk_order_menu_date']; ?>):</H1>
<table class = "menu_table">
<tr><td>Наименование</td><td>Размер порции</td><td>Цена(руб.)</td><td>Заказать</td></tr>
	<?php
		$type = "none";
		$session = Session::instance();
		foreach ($menu as $key => $value)
		{
			if ($type != $value['type'])
			{
				$type=$value['type'];
				echo "<tr><td colspan=\"5\">$type</td></tr>";
			}
			echo "<tr><form id=\"add_form".$key."\" action=\"./add_to_cart\" method=\"post\">
 					<td>".$value['dish_name']."</td>
					<td><select name=\"portion\">";
					$price = null;
					foreach ($value['portions'] as $portion_id => $portion_value)
					{
						echo "<option value=\"".$portion_id."\">".$portion_value['type_name']."</option>";
						$price .= $price?"\\".$portion_value['price']:$portion_value['price'];
					}
					echo "</select>
					</td>
					<td>".$price."</td>
					<td><input type=\"number\" min=\"1\" max = \"50\" maxlength=\"2\" name=cart[".$key."] value=1></td>
					<td>
					<input type=\"button\" name=\"smbt_make_order\" class=\"add_button\" id=\"btn_submit[".$key."]\" onclick=\"add_to_cart(".$key.")\" value=\"Заказать\"></td>
				</form></tr>";
		}
	?>
</table>
</div>

<script>
	$('.btn-slide').live("click", function()
			{
				$("#cart").slideToggle("slow");
				$(this).toggleClass("active"); 
				return false;
			}
			);
</script>
<style>
	.cart
	{
		position: fixed; 
		bottom:0px; 
		right:0px;
		z-index:100;
	}
	#cart
	{
		text-align: center;
		font-size: 12pt;
		display: none;
		width: 250px; 
		height: 300px;
		overflow:auto;
		border-radius: 6px;
		padding-top: 20px;
		border: 1px solid white;
		background-color: rgba(150, 150, 150, 0.9);
	}
	.slide
	{
		border: 1px solid #333;
		display:inline;
		padding:15px;
		border-radius:6px;
		margin-right:15px;
		background-color: rgb(250,250,30);
	}
</style>
<div class="cart" align ="right">
<p class="slide"><a href="#" class="btn-slide">Мой заказ</a></p>
<div id="cart">

</div>
</div>