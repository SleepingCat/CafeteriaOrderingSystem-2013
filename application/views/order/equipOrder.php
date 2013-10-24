<form action = "../EquipOrder/action_Equip" method = "POST"> 
<h1 align = "center"> На данный момент комплектуются заказы для интервала <br> 
<input type = "text" name = "Time" Value = "<?php echo Arr::get(period) ?>"> </h1> <br>
<label>Всего заказов на интервал:<input type = "text" name = "totalOrder" Value = "<?php echo Arr::get(nowOrders) ?>" size = 5></label> 
<div align = "right"> <label>Осталось укомплектовать:<input type = "text" name = "balance" Value = "<?php echo Arr::get(nowOrders) ?>" size = 5></label></div><br>
<div align = "center"><input type = "submit" name = "getOrder" value = "Получить заказ для комплектования"></div><br>
<div align = "center"><input type = "submit" name = "showOrder" value = "Просмотреть заказ"></div>
</form>