<form action = "../CreateMenu/RunAction" method = POST>
  <?php
   echo "Перечень меню на дату <input type = \"date\" name = \"menuDate\" value = ".$menu_date.">";
   echo "<input type = \"submit\" value = \"Обновить\" name = \"butUpdate\"><br>";
   echo "<table border = 1 align = \"center\" width = 500>";
   for ($i = 0; $i < count($setOfMenu); $i++) 
   {
     echo "<tr>
   		     <td>Меню на ".$setOfMenu[$i]["menu_date"]."<td>
     	     <td><input type = \"submit\" size = 100 name =\"edit[".$i."]\" value = \"Редактировать\"></td>
   		     <td><input type = \"submit\" size = 100 name =\"delete[".$i."]\" value = \"Удалить\"></td>
   		   </tr>";  
   }
   echo "</table>";
   echo "<br><input type = \"submit\" name = \"butAddMenu\" value = \"Создать меню\">";
  ?>
  </form>