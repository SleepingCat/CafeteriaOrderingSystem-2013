<script>
  
</script>
<form action = "../RcptOnPay/GenerateCheck" method = POST>
  Генерция чека на оплату с 
  <input type = "date" name = "beginDate">  по
  <input type = "date" name = "endDate"><br>
  <input type = "submit" name = "GenerateCheck" value = "Сформировать"><br>
  <?php echo $message;?>
</form>