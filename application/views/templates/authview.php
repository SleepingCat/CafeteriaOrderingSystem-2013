<?php echo HTML::style('media/css/authview.css');?>

<form class="Login" action="" method="post">
<div class="FormTopBorder">Введите ваши имя пользователя и пароль</div>
<div class="FormArea">
	Имя пользователя: <br>
    <input type="text" class="TextBox" /> <br>
    <p></p>
    Пароль: <br>
    <input type="password" class="TextBox" /> <br>
    <?php if(isset($error)){?>
    	<p></p>
    	<span id="fail">Имя пользователя или пароль введены неверно!</span>
    <?}?>
</div>
<div class="FormBottomBorder">
	<input type="submit" class="EntBut EntBut-color" id="EntAuth" value="Войти" name="subm" />
</div>				
</form>