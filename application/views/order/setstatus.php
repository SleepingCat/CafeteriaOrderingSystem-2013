<form action="/deliveryorder/orderanswerstatus" method="POST">
<?php
echo "Заказ №".$OrderNumb."</br>";
?>
<div align = "center">
<label>Статус заказа: 
    <select name = "ChosenStatus" id = "ChosenStatus">
        <option><?php echo $CurrentState ?></option>
        <option>Доставлен</option>
        <option>Не доставлен</option>
     </select>
 </div>
</label>
<div align = "center"><input type = "submit" value = "ОК" id = "DOK" name = "DOK" ></div>
</form>