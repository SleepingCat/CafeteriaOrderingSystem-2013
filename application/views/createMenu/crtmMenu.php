<form>
  <?php
    //Определяем первоначалные категории и типы блюд. 
    $currentType = $allDish[0]['dishTypeName'];
    $currentCategory = $allDish[0]['dishCategName'];
    $currentDish = '';
    $isFirstDish = true; /** указывает на то, что блюдо 
                             первое в своей категории и не надо закрывать тег tr**/
    $totalCount = count($allDish);
    //Заголовок всех таблиц.
    $header = "<table border = \"solid 1px black\"  align=\"center\"  bgcolor=\"#A0522D\"  width= 500>
    		     <tr>
    		       <th>Наименование</th>
    		       <th>Ингредиенты</th>
    	           <th>Стоимоcть</th>
    		     </tr>";
    
    echo "<span style=\"Color:#FF8C00; Font-size:20pt\">".$currentType."</span><br>";
    echo $currentCategory;
    echo $header;
    
    for ($i = 0; $i < $totalCount; $i++) 
    {
    	//Проверяем не изменился ли тип блюда(и как следствие обновляем категорию блюда).
    	if($currentType != $allDish[$i]['dishTypeName'])
    	{   
    		echo"</td>
    			 <td>
    			   <input type = \"text\" name = \"price\"".$i.">
    			 </td>
    		   </tr>
    		 </table><br>";
    		$currentType = $allDish[$i]['dishTypeName'];
    		echo "<span style=\"Color:#FF8C00; Font-size:20pt\">".$currentType."</span><br>";
    		
			$currentCategory = $allDish[$i]['dishCategName'];
			echo $currentCategory;
			echo $header;
			$isFirstDish = true;
    	}
    	if($currentCategory != $allDish[$i]['dishCategName'])//Проверяем категорию блюда отдельно.
    	{
    		echo "</td>
    			  <td>
    			    <input type = \"text\" name = \"price\"".$i.">
    			  </td>
    			</tr>
    		</table>";
    		$currentCategory = $allDish[$i]['dishCategName'];
    		echo $currentCategory;
    		echo $header;
    		$isFirstDish = true;
    	}
    	
    	//Проверяем не изменилось ли блюдо.
        if($allDish[$i]['dishName'] != $currentDish)
        {
        	if ($isFirstDish)//не закрываем tr
        	{
              echo "<tr><td>".$allDish[$i]['dishName']."</td><td>";
              $isFirstDish = false;
        	}
        	else //предварительно закрываем tr
        	{
        		echo "</td>
        			  <td>
        				<input type = \"text\" name = \"price\"".$i.">
        			  </td>
        			</tr>
        			<tr>
        			  <td>".$allDish[$i]['dishName']."</td>
        			  <td>";
        	}	
    	      
    	    $currentDish = $allDish[$i]['dishName']; //Меняем текущее блюдо.
        }
        //Добавляем очередной ингредиент блюда.
        echo $allDish[$i]['productName']."; ";
        if($i == $totalCount-1)
          echo "</td>
          		<td>
          		  <input type = \"text\" name = \"price\"".$i.">
          		</td>
          	  </tr>
          	</table><br>";    			  
    }
  ?>
  <input type = "submit" value = "Добавить блюдо">
</form>	