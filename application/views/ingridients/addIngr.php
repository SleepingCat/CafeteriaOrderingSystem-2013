<form action="/AddIngr/AddData" method="POST"> 
	<div align = "center"> Введите сведения о добавляемом ингредиенте: </div> <br>
		<div align = "center"> Название ингредиента: <input type = Text name = "Name"></div> <br>
			<div align = "center"> Количество: <input type = Text name = "Balance"></div> <br>
			<div align = "center"> <?php echo $text?> </div><br>
		<div align = "center"> <input type = "submit" name = "addIngr" value = "Добавить"> </div>
</form>