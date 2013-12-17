<?php defined('SYSPATH') or die('No direct script access.');?>

<div class="PageHeader">Список ингредиентов</div>

<form action="/ListIngr/index" method="POST">

<div align="center" style="margin: 10px 70px 15px 0px; display: inline-block;">
	<input type="submit" name = "newIngr" value="Добавить новый ингредиент" class="EntBut EntBut-color" style="width: 270px; line-height: 30px;">
</div>
<div align="center" style="margin: 10px 0px 15px 70px; display: inline-block;">
	<input type="submit" name="delete" id="delete_button" value="Удалить выбранные ингредиенты" class="EntBut EntBut-color" style="width: 270px; line-height: 30px;">
</div>

<table class="DataTable" style="width: 560px; margin: 10px 100px;">
<tr>
	<th class="DataCell DataTableHeader ColoredRow" style="width: 25px;"></th>
	<th class="DataCell DataTableHeader ColoredRow" style="width: 295px;">Ингредиент</th>
	<th class="DataCell DataTableHeader ColoredRow" style="width: 120px;">Количество</th>
	<th class="DataCell DataTableHeader ColoredRow" style="width: 120px;">Размерность</th>
</tr>
<?php $i = 0;
foreach ($list as $key => $value)
{ ?>
<tr>
	<td class="DataCell" style="vertical-align: middle; text-align: center;">
		<input type="checkbox" class="styled" name="check[<? echo $i; ?>]">
	</td>
	<td class="DataCell" style="vertical-align: middle; text-align: center; white-space: nowrap;">
		<? echo $value['product_name']; ?>
	</td>
	<td class="DataCell" style="vertical-align: middle; text-align: center;">
		<? echo $value['balance']; ?>
	</td>
	<td class="DataCell" style="vertical-align: middle; text-align: center;">
		<? echo $value['dimension']; ?>
	</td>		
</tr>
<? $i++; }?>
</table>
</form>

















<!--  
<form action="/ListIngr/index" method="POST"> 
	<div id = "добавление" align = "center"> <label for = "добавление"> Добавить новый ингредиент: </label>
	 <input type = "submit" name = "newIngr" value = "Добавить"> </div> <br>
			<div align = "center"> Список ингредиентов: </div>
				<div align = "center"><table> <tr><td> √ </td> <td> Ингредиент </td><td> Количество </td><td>Размерность</td></tr>
					<?php
						$i = 0;
						foreach ($list as $key => $value)
						{
						   echo "<tr><td><input type=\"checkbox\" class=\"checkbox_ingr\" name=\"check[".$i."]\"></td>
								 <td align = \"center\">".$value['product_name']."</td>
								 <td align = \"center\">".$value['balance']."</td>
								 <td align = \"center\">".$value['dimension']."</td></tr>";
						   $i++;
						}
					?>
				</table></div><br>
			<input type = "submit" name = "delete" id="delete_button" value = "Удалить выбранные ингредиенты">
</form>-->