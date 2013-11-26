<form action="/ListDishType/index" method="POST">
	<div id="добавление" align="center">
		<label for="добавление"> Добавить новый тип блюда: </label> 
		<input type="submit" name="newType" value="Добавить">
	</div>
	<br>
	<div align="center">Типы блюд:</div>
	<div align="center">
		<table border=solid 1px black bgcolor=#A0522D>
			<tr>
				<td>√</td>
				<td>Наименование</td>
			</tr>
					<?php
					$i = 0;
					foreach ( $list as $key => $value ) {
						$i ++;
						echo "<tr><td><input type=\"checkbox\" class=\"checkbox_type\" name=\"check[". $i ."]\"></td><td align = \"center\">". $value ['name'] ."</td></tr>";
					}
					?>
		</table>
	</div>
	<br>
	<div align="center">
		<input type="submit" name="delete" id="delete_button"
			value="Удалить выбранные поля">
	</div>
</form>