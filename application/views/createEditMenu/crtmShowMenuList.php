<?php defined('SYSPATH') or die('No direct script access.');?>

<div class="PageHeader">Перечень меню</div>
<form action = "../CreateMenu/RunAction" method = POST>
<div class="TitledTextboxArea">
	<label for="Start">Перечень меню на дату:</label>
	<input type="text" name="menuDate" id="menu_create_datepicker" value="<?php echo $menu_date ?>"	class="ProfileTextBox" size="20" maxlength="10">
	<input type="submit" value ="Обновить" name="butUpdate" class="EntBut EntBut-color" style="width: 100px; line-height: 24px;">
</div>
<div style="margin-top: 15px;">
	<input type="submit" name="butAddMenu" value="Создать меню" class="EntBut EntBut-color" style="width: 200px; line-height: 30px;">	
</div>
<table class="DataTable" style="width: 400px; margin: 15px 180px;">
<tr>
	<th class="DataCell DataTableHeader ColoredRow" style="width: 200px;">Дата меню</th>
	<th class="DataCell DataTableHeader ColoredRow" style="width: 200px;">Действие</th>
</tr>
<?php for ($i = 0; $i < count($setOfMenu); $i++) 
   { ?>
<tr>
	<td class="DataCell" style="vertical-align: middle; text-align: center;">
		<?php echo DateTime::createFromFormat("Y-m-d", $setOfMenu[$i]["menu_date"])->format("d.m.Y") ?>
	</td>
	<td class="DataCell" style="white-space: nowrap;">
		<input type="submit" name ="edit[<? echo $i; ?>]" value="Изменить" class="EntBut EntButLeft"
		><input type="submit" name ="delete[<? echo $i; ?>]" value="Удалить" class="EntBut EntButRight">
	</td>	
</tr>
<? }?>
</table>
</form>