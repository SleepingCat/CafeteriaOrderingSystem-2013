<form action="/ListMenuType/AddData" method="POST">
	<div align="center">
		Введите новую категорию меню: <input type=Text name="Name">
	</div>
	<br>
	<div align = "center"> 
		Приоритет: <input type = Text name = "Priority">
	</div>
	<br>
		<div align = "center"> <?php echo $text?> </div><br>
	<table align="center">
		<tr>
			<td><input type="submit" name="addType" value="Добавить"></td> <td>   </td>
			<td><input type="submit" name="reverse"
				value="Вернуться к списку категорий меню"></td>
		</tr>
	</table>
</form>