<form action = "../CreateMenu/RunAction" method = "POST">
  Выбрать блюдо из: 
  <select name = "type">
  <?php
  for ($i = 0; $i < count($typeOfDish); $i++)
  {
    echo "<option value = ".$typeOfDish[$i]["id"].">".$typeOfDish[$i]["name"]."</option>";
  }  
  ?>
  </select>
  <br>
  Категории: 
  <select name = "category">
  <?php 
  for ($i = 0; $i < count($categoryOfDish); $i++)
  {
  echo "<option value = ".$categoryOfDish[$i]["id"].">".$categoryOfDish[$i]["name"]."</option>";
  }
  ?>
  </select>
  <input type = "submit" value = "выбрать" name = "butSelect">
</form>