<style>
table
{
	border:1px solid black;
	background:#cd853f;
}
td
{
	border:1px solid black;
	padding:0px 7px;
}
</style>
<form action="/ListMenuType/index" method="POST"> 
	<div id = "добавление" align = "center"> <label for = "добавление"> Добавить новую категорию меню: </label>
	 <input type = "submit" name = "newTypeMenu" value = "Добавить"> </div> <br>
			<div align = "center"> Список типов меню: </div>
				<div align = "center"><table> <tr><td>√</td> <td> Наименование </td><td> Приоритет </td></tr>
					<?php
						$i = 0;
						foreach ($list as $key => $value)
						{
						   echo "<tr><td><input type=\"checkbox\" class=\"checkbox_menu\" name=\"check[".$i."]\"></td width = \"30\"><td align = \"center\">".$value['name']."</td><td align = \"center\">".$value['priority']."</td></tr>";
						   $i++;
						}
					?>
				</table></div><br>
			<input type = "submit" name = "delete" id="delete_button" value = "Удалить выбранные поля">
</form>