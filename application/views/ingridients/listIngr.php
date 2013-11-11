<form action="/ListIngr/index" method="POST"> 
	<div id = "добавление" align = "center"> <label for = "добавление"> Добавить новый ингредиент: </label>
	 <input type = "submit" name = "newIngr" value = "Добавить"> </div> <br>
			<div align = "center"> Список ингредиентов: </div>
				<div align = "center"><table border = solid 1px black bgcolor = #A0522D> <tr> <td> Ингредиент </td><td> Количество </td></tr>
					<?php
						foreach ($list as $key => $value)
						{
						   echo "<tr><td align = \"center\">".$value['product_name']."</td><td align = \"center\">".$value['balance']."</td></tr>";
						}
					?>
				</table></div><br>
</form>