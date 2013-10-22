<?php 
/*
 * тут вывод формы ввода даты меню
 * и вывода ошибок
 */
?>
<form action="" method="post">
	Дата меню:
	<input type="text" name="menu_date">
	<input type="submit" name="smbt">
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
		}
	}
	?>
</form>