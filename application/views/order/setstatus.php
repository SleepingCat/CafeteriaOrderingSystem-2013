<form action="/Deliveryorders/orderanswerstatus" method="POST">
<?php
echo "Заказ №".$OrderNumb."</br>";
?>
<div align = "center">
<label>Статус заказа: 
    <select name = "ChosenStatus" id = "ChosenStatus">
        <option><?php echo $CurrentState ?></option>
        <option><?php if(!($CurrentState == $States::Delivered)) echo $States::Delivered; else echo $States::Complected;?></option>
        <option><?php if(!($CurrentState == $States::NotDelivered)) echo $States::NotDelivered; else echo $States::Complected;?></option>
     </select>
 </div>
</label>
<div align = "center"><input type = "submit" value = "ОК" id = "DOK" name = "DOK" ></div>
</form>