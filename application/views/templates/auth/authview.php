<?php defined('SYSPATH') or die('No direct script access.');
?>
<form class="Login"  action="" method="post">
<div class="FormTopBorder">Введите ваши имя пользователя и пароль</div>
<div class="FormArea">
	Имя пользователя: <br>
    <input type="text" class="TextBox" id="login" name="login" /> <br>
    <p></p>
    Пароль: <br>
    <input type="password" class="TextBox" id="password" name="password"/> <br>   
    
    <?php if( $error =="looser")    
    {?>    	
    <span class="fail">Вы уволены</span>
    <?}
    else
    	 
    if( $error == "error")
    {?> 
    <span class="fail">Имя пользователя или пароль введены неверно!</span>
    <?}   
    ?>   
    
</div>
<div class="FormBottomBorder">
	<input type="submit" class="EntBut EntBut-color EntAuth" id="submit" value="Войти" name="subm" />
</div>				
</form>