<form action = "order/orderanswerstatus" method = "POST">
<?php
echo "Заказ №".$OrderNumb."</br>";
?>
<div align = "center">
<select>
    <option> disabled><?php echo $CurrentStatus ?></option>
    <option>Доставлен</option>
    <option>Не доставлен</option>
</select> </div>
<div align = "center"><input type = "submit" value = "ОК" id = "findButton" name = "findButton" ></div>
</form>