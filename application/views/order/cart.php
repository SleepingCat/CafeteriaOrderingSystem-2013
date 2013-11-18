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
<?php


	/*
	 * Корзина с возможностью редактирования до оформления заказа
	 */
	if (isset($_SESSION['order']))
	{
		$summ = 0;
		foreach ($_SESSION['order'] as $key => $value)
		{
			echo $value['dish_name']."(".$value['portions'][$value['portion']]['price'].") x".$value['servings_number']."<a href=\"http://".$_SERVER['HTTP_HOST']."/order/remove/".$key."\">Удалить</a><br>";
			$summ += $value['portions'][$value['portion']]['price']*$value['servings_number'];
		}
		echo "Итого: ".$summ."<br>";
		echo "<a class=\"btn_submit\" href=\"http://".$_SERVER['HTTP_HOST']."/order/clear\"><button>Очистить</button></a>
		<a href=\"http://".$_SERVER['HTTP_HOST']."/order/confirm\"><button>Оформить</button></a>";
	}
	else 
	{
		echo "Пусто =(<br>";
	}
	/*
	 * 
	 */
?>
</div>
</div>