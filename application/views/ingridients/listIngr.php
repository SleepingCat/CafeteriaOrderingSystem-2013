<form action="/ListIngr/index" method="POST"> 
	<div id = "добавление" align = "center"> <label for = "добавление"> Добавить новый ингредиент: </label>
	 <input type = "submit" name = "newIngr" value = "Добавить"> </div> <br>
			<div align = "center"> Список ингредиентов: </div>
				<div align = "center"><table border = solid 1px black bgcolor = #A0522D> <tr><td> √ </td> <td> Ингредиент </td><td> Количество </td></tr>
					<?php
						$i = 0;
						foreach ($list as $key => $value)
						{
						   echo "<tr><td><input type=\"checkbox\" class=\"checkbox_ingr\" name=\"check[".$i."]\"></td><td align = \"center\">".$value['product_name']."</td><td align = \"center\">".$value['balance']."</td></tr>";
						   $i++;
						}
					?>
				</table></div><br>
			<input type = "submit" name = "delete" id="delete_button" value = "Удалить выбранные ингредиенты">
</form>