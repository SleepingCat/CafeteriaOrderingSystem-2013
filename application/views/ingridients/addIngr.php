<form action="/ListIngr/AddData" method="POST"> 
	<div align = "center"> Введите сведения о добавляемом ингредиенте: </div> <br>
		<div align = "center"> Название ингредиента: <input type = Text name = "Name"></div>
			<div align = "center"> Количество: <input type = Text name = "Balance"></div>
				<div align = "center"> Размерность: <input type = Text name = "Dimension"></div>
			<div align = "center"> <?php echo $text?> </div><br>
		<table align = "center"> <tr> <td> <input type = "submit" name = "addIngr" value = "Добавить"> </td> <td>   </td>
			<td> <input type = "submit" name = "reverse" value = "Вернуться к списку ингредиентов"> </td> </tr> </table>
</form>