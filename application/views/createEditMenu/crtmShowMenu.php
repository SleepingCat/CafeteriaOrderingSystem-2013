<form action = "../CreateMenu/RunAction" method = POST>
  <?php
    //текущие тип и категория блюда
    $currentType = '';
    $currentCategory = '';
    $totalCount = Count($allDish); 
    $checkBox = "";

    if(!$forEdit)
    {
    	echo " <select name = \"type\">";
    	for ($i = 0; $i < count($typeOfDish); $i++)
    	{
    		echo "<option value = ".$typeOfDish[$i]["id"].">".$typeOfDish[$i]["name"]."</option>";
    	}
    	echo "</select>";
    	
    	echo " <select name = \"type\">";
    	for ($i = 0; $i < count($categoryOfDish); $i++)
    	{
    	echo "<option value = ".$categoryOfDish[$i]["id"].">".$categoryOfDish[$i]["name"]."</option>";
    	}
    	echo "</select>";
    	echo "<input type = \"submit\" value = \"Применить\" name = \"butApply\">";
    }
    
    //Заголовок всех таблиц.
    if($forEdit) // если режим редактирования существующего меню, то убираем checkbox из заголовка
      $header = "<table style=\"margin:0px\" border = \"solid 1px black\"  align=\"center\">
	    		     <tr>
	    		       <th>Наименование</th>
	    		       <th>Ингредиенты</th>
	    	           <th>Стоимоcть</th>
	    		     </tr>";
    else // если режим добавления новых блюд в меню, то убираем цену и добавляем checkbox
    	$header = "<table style=\"margin:0px\" border = \"solid 1px black\"  align=\"center\" >
	    		     <tr>
	    			   <th> </th>
	    		       <th>Наименование</th>
	    		       <th>Ингредиенты</th>
	    		     </tr>";
    
    // заголовок страницы
    echo "Меню на ".$menuDate."<br>";
    
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
		    	  $checkBox = "<td style=\"width : 10px\"><input type = \"checkBox\" checked=\"checked\" name = checked_elements[".$i."] onClick = \"return false;\"></td>";
		    	else 
		    	  $checkBox = "<td style=\"width : 10px\"><input type = \"checkBox\" name = checked_elements[".$i."]></td>";
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
	    	  echo "</td><td style=\"width : 100px\"><input type = \"text\" style=\"width : 100%\"  name = price[".$i."] value = ".$allDish[$i]["price"]."></td></tr>";
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
	    echo "<input type = \"submit\" name = \"butSave\"  value = \"Сохранить\">";
    }
  ?>
  </form>