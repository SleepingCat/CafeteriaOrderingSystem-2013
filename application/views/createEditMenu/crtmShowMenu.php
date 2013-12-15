<script>
function checkprice()
{
  $(".priceTextBox").each(function()
  {
    if(!$.isNumeric($(this).val()) || ($(this).val() == 0))
	{
	  alert('Заполните цены у всех блюд!');
	  return false;
    }
   }
  );
}

</script>
<form action = "../CreateMenu/RunAction" method = POST align = "center">
  <?php
    //текущие тип и категория блюда
    $currentType = '';
    $currentCategory = '';
    $totalCount = Count($allDish); 
    $checkBox = "";
    echo "Меню на ".$menuDate."<br>";
    echo "<div align = \"left\"><input type = \"submit\" name = \"toMenuList\" value = \"К списку меню\"></div><br>";
    echo "<div align = \"right\">".$message."</div><br>";
    
    if(!$forEdit)
    {
    	echo "<select name = \"typeOfDish\">";
    	for ($i = 0; $i < count($typeOfDish); $i++)
    	{
    		echo "<option value = ".$typeOfDish[$i]["id"].">".$typeOfDish[$i]["name"]."</option>";
    	}
    	echo "</select>";
    	
    	echo "<select name = \"categoryOfDish\">";
    	for ($i = 0; $i < count($categoryOfDish); $i++)
    	{
    	echo "<option value = ".$categoryOfDish[$i]["id"].">".$categoryOfDish[$i]["name"]."</option>";
    	}
    	echo "</select>";
    	echo "<input type = \"submit\" value = \"Применить\" name = \"butApply\"><br>";
    }
    
    //Заголовок всех таблиц.
    if($forEdit) // если режим редактирования существующего меню, то убираем checkbox из заголовка
    {
      // заголовок страницы
      $header = "<table  border = \"solid 1px black\"  align =\"center\">
	    		     <tr>
	    		       <th>Наименование</th>
	    		       <th>Ингредиенты</th>
	    	           <th>Стоимоcть</th>
    			       <th></th>
	    		     </tr>";
    }
    else // если режим добавления новых блюд в меню, то убираем цену и добавляем checkbox
    {
    	// заголовок страницы
    	$header = "<table  border = \"solid 1px black\" align =\"center\">
	    		     <tr>
	    			   <th> </th>
	    		       <th>Наименование</th>
	    		       <th>Ингредиенты</th>
	    		       <th></th>	
	    		     </tr>";
    }
    
   
    
    //вывод блюд
    if(count($allDish) > 0) 
    {
	    for ($i = 0; $i < $totalCount; $i++) 
	    {
	    	// массив для вывода ингредиентов.
	    	$tmpArray = array();
	    	if(!$forEdit)// если мы в режиме добавления блюда то выводим checkbox	
	    	{
		    	if($allDish[$i]['is_standart'])
		    	  $checkBox = "<td style=\"width : 10px\"><input type = \"checkBox\" class = \"styled\" checked=\"checked\" name = checked_elements[".$i."] onClick = \"return false;\"></td>";
		    	else 
		    	  $checkBox = "<td style=\"width : 10px\"><input type = \"checkBox\" class = \"styled\" name = checked_elements[".$i."]></td>";
	    	}
	    	
	    	
	    	// выводим блюдо
	    	if ($currentType != $allDish[$i]["dish_type"]) //если сменился тип блюда
	    	{
	    		echo "</table>";
	    		$currentType =  $allDish[$i]['dish_type'];
	    		$currentCategory =  $allDish[$i]['dish_categ'];
	    		echo "<span style=\"Color:#FF8C00; Font-size:20pt\">".$currentType."</span><br>";
	    		echo $currentCategory;
	    		echo $header;
	    	}
	    	if($currentCategory != $allDish[$i]['dish_categ']) //если сменилась категория блюда
	    	{
	    		echo "</table>";
	    		$currentCategory =  $allDish[$i]['dish_categ'];
	    		echo $currentCategory;
	    		echo $header;
	    	}
	    	
	    	echo "<tr>";
	    	echo $checkBox;   	 
	    	echo "<td style=\"width : 100px\">".$allDish[$i]["dish_name"]."</td>";
	    	echo "<td  style=\"width : 370px\">";
	    	$tmpArray = $allDish[$i]['ingredients'];
	    	$subCount = count($tmpArray);
	    	for ($j = 0; $j < $subCount; $j++)//вывод ингредиентов блюда
	    	{
	    		echo $tmpArray[$j]['product_name']."; ";
	    	}
	    	if($forEdit)
	    	  echo "</td>
	    			<td style=\"width : 100px\">
	    			  <input type = \"text\" style=\"width : 80%\" class = \"priceTextBox\"  name = price[".$i."] value = ".$allDish[$i]["price"]."></td>
	    			<td><input type = \"submit\" name = deleteDish[".$i."] value = \"Удалить\"></td>
	    		</tr>";
	    	if($totalCount - 1 == $i)
	    	{
	    		echo "</table>";
	    	}
	    }
    }
    else 
    	echo "Нет ни одного блюда";
    if(!$forEdit)
    {
    	echo "<br><input type = \"submit\" name = \"addInMenu\"  value = \"Добавить\">";
    	echo "<input type = \"submit\" name = \"butCancel\"  value = \"Отмена\">";
    }
    else 
    {
	    echo "<br><input type = \"submit\" name = \"butAddDish\"  value = \"Добавить блюдо\">";
	    echo "<input type = \"submit\" name = \"butSave\" id=\"butSaveMenu\" onmousedown=\"checkprice()\" value = \"Сохранить\">";
    }
  ?>
  </form>