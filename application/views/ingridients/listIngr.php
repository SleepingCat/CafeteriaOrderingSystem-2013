<form action="/ListIngr/index" method="POST"> 
	<div id = "добавление" align = "center"> <label for = "добавление"> Добавить новый ингредиент: </label>
	 <input type = "submit" name = "newIngr" value = "Добавить"> </div> <br>
			<div align = "center"> Список ингредиентов: </div>
				<div align = "center"><table border = solid 1px black bgcolor = #A0522D> <tr><td> √ </td> <td> Ингредиент </td><td> Количество </td></tr>
					<?php
						$i = 0;
						foreach ($list as $key => $value)
						{
						   $i++;
						   echo "<tr><td><input type=\"checkbox\" name=\"check".$i."\"></td><td align = \"center\">".$value['product_name']."</td><td align = \"center\">".$value['balance']."</td></tr>";
						}
					?>
				</table></div><br>
</form>