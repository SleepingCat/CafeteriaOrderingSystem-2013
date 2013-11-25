<?php 
/*
 * тут вывод формы ввода даты меню
 * и вывода ошибок
 */
?>
<script type="text/javascript">
    $(document).ready(function () {
        $('#menu_datepicker').datepicker({ firstDay: 1, dateFormat: 'yy-mm-dd' });
    });
</script>
<form action="/menu" method="post">
	Дата меню:
	<input type="text" name="menu_date" id="menu_datepicker">
	<input type="submit" class="btn_submit" name="smbt">
	<br>
	<?php 
	if (isset($error_code)) 
	{
		switch ($error_code)
		{
			case 1: echo "Заполните поле"; break;
			case 2: echo "Неверный формат даты"; break;
			case 3: echo "Меню на указанную дату не существует"; break;
			case 4: echo "Нельзя заказать на прошедшую дату"; break;
			case 5: echo "Выберите дату меню"; break;
			case 6: echo "К сожалению на сегодня меню нет, выберите другую дату."; break;
		}
	}
	?>
</form>