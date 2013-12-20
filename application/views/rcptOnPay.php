<script type="text/javascript">
    $(document).ready(function () {
        $('.menu_datepicker').datepicker({ firstDay: 1, dateFormat: 'yy-mm-dd' });
    });
</script>
<form action = "../RcptOnPay/GenerateCheck" method = POST>
  Генерция чека на оплату с 
  <input type = "date" name = "beginDate" class="menu_datepicker">  по
  <input type = "date" name = "endDate" class="menu_datepicker"><br>
  <input type = "submit" name = "GenerateCheck" value = "Сформировать"><br>
  <?php echo $message;?>
</form>