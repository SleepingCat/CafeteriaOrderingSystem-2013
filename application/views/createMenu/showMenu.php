<form action = "../CreateMenu/RunAction" method = POST>
  <?php
    //текущие тип и категория блюда
    $currentType = '';
    $currentCategory = '';
    $totalCount = Count($allDish);
    
    //Заголовок всех таблиц.
    $header = "<table border = \"solid 1px black\"  align=\"center\"  bgcolor=\"#A0522D\" >
	    		     <tr>
	    			   <th> </th>
	    		       <th id=\"crtm_Name\" >Наименование</th>
	    		       <th>Ингредиенты</th>
	    	           <th>Стоимоcть</th>
	    		     </tr>";

    for ($i = 0; $i < $totalCount; $i++) 
    {
    	// массив для вывода ингредиентов.
    	$tmpArray = array();
    	
    
    	
    	/**определяем наличие возможности выбора блюда по его стандартности.
    	 * Стандартные блюда выбраны по умолчанию.
    	 */
    	if($allDish[$i]['is_standart'])
    	  $checkBox = "<td style=\"width : 10px\"><input type = \"checkBox\" checked=\"checked\" name = checked_elements[".$i."] onClick = \"return false;\"></td>";
    	else 
    		
    	  $checkBox = "<td style=\"width : 10px\"><input type = \"checkBox\" name = checked_elements[".$i."]></td>";
    	
    	// выводим блюда
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
    	echo "<tr>".$checkBox."<td style=\"width : 100px\">".$allDish[$i]["dish_name"]."</td>";
    	echo "<td  style=\"width : 490px\">";
    	$tmpArray = $allDish[$i]['ingredients'];
    	$subCount = count($tmpArray);
    	for ($j = 0; $j < $subCount; $j++)
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