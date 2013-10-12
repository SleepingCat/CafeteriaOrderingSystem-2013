<?php echo HTML::style('media/css/authview.css');?>

<form class="Login"  action="" method="post">
<div class="FormTopBorder">Введите ваши имя пользователя и пароль</div>
<div class="FormArea">
	Имя пользователя: <br>
    <input type="text" class="TextBox" id="login" name="login" /> <br>
    <p></p>
    Пароль: <br>
    <input type="password" class="TextBox" id="password" name="password"/> <br>
    <?php if(isset($error)){?>
    	<p></p>
    	<span class="fail">Имя пользователя или пароль введены неверно!</span>
    <?}?>
</div>
<div class="FormBottomBorder">
	<input type="submit" class="EntBut EntBut-color EntAuth" id="submit" value="Войти" name="subm" />
</div>				
</form>