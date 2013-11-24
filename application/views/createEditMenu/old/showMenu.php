<form action = "../CreateMenu/RunAction" method = POST>
  <?php
    //текущие тип и категория блюда
    $currentType = '';
    $currentCategory = '';
    $totalCount = Count($allDish);
    
    //Заголовок всех таблиц.
    $header = "<table style=\"margin:0px\" border = \"solid 1px black\"  align=\"center\"  bgcolor=\"#A0522D\" >
	    		     <tr>
	    			   <th> </th>
    		           <th>Тип порции</th>
	    		       <th>Наименование</th>
	    		       <th>Ингредиенты</th>
	    	           <th>Стоимоcть</th>
	    		     </tr>";
    for ($i = 0; $i < $totalCount; $i++) 
    {
    	// массив для вывода ингредиентов.
    	$tmpArray = array();
    	
    
    	
    	
    	if($allDish[$i]['is_standart'])
    	  $checkBox = "<td style=\"width : 10px\"><input type = \"checkBox\" checked=\"checked\" name = checked_elements[".$i."] onClick = \"return false;\"></td>";
    	else 
    		
    	  $checkBox = "<td style=\"width : 10px\"><input type = \"checkBox\" name = checked_elements[".$i."]></td>";
    	
    	
    	// выводим блюдо
    	if ($currentType != $allDish[$i]["dish_type"]) 
    	{
    		echo "</table>";
    		$currentType =  $allDish[$i]['dish_type'];
    		$currentCategory =  $allDish[$i]['dish_categ'];
    		echo "<span style=\"Color:#FF8C00; Font-size:20pt\">".$currentType."</span><br>";
    		echo $currentCategory;
    		echo $header;
    	}
    	if($currentCategory != $allDish[$i]['dish_categ'])
    	{
    		echo "</table>";
    		$currentCategory =  $allDish[$i]['dish_categ'];
    		echo $currentCategory;
    		echo $header;
    	}
    	
    	echo "<tr>";
    	echo $checkBox;
    	// выводим типы порций
    	echo "<td><select name = type_of_portion[".$i."]>";
    	for ($k = 0; $k < count($portionType); $k++) 
    	{
    		echo "<option value = ".$portionType[$k]["id"].">".$portionType[$k]["type_name"]."</option>";
    	}
    	echo "</select></td>";
    	 
    	echo "<td style=\"width : 100px\">".$allDish[$i]["dish_name"]."</td>";
    	echo "<td  style=\"width : 370px\">";
    	$tmpArray = $allDish[$i]['ingredients'];
    	$subCount = count($tmpArray);
    	for ($j = 0; $j < $subCount; $j++)//вывод ингредиентов блюда
    	{
    		echo $tmpArray[$j]['product_name']."; ";
    	}
    	
    	echo "</td><td style=\"width : 100px\"><input type = \"text\" style=\"width : 100%\"  name = price[".$i."]></td></tr>";
    	if($totalCount - 1 == $i)
    	{
    		echo "</table>";
    	}
    }
    echo "<input type = \"submit\" name = \"butAddDish\"  value = \"Добавить блюдо\">";
    echo "<input type = \"submit\" name = \"butSave\"  value = \"Сохранить\">";
  ?>
  </form>