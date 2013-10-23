<form action="/deliveryorder/ordersetnewstatus" method="post">
  <div align = "center">
    <b>Изменить статус заказа</b>
  </div>
  <br>
  <div align = "cente">
    <?php
      echo "Присвоить заказу №".$CurrNumb." статус ".$Status."<br>" 
    ?>    
  </div>
  <div>
     <div align = "left"><input type = "submit" value = "Да" id = "bOK" name = "bOK" ></div>
     <div align = "right"><input type = "submit" value = "Отмена" id = "bClose" name = "bClose" ></div>
  </div>
</form>