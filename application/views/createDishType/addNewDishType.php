<form action="/ListDishType/AddData" method="POST">
	<div align="center">
		Введите наименование нового типа блюда: <input type=Text name="Name">
	</div>
	<br>
		<div align = "center"> <?php echo $text?> </div><br>
	<table align="center">
		<tr>
			<td><input type="submit" name="addType" value="Добавить"></td> <td>   </td>
			<td><input type="submit" name="reverse"
				value="Вернуться к списку типов блюд"></td>
		</tr>
	</table>
</form>