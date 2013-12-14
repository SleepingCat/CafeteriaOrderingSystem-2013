<?php defined('SYSPATH') or die('No direct script access.');?>

<?if( $error =="looser")
{?> 
	<div class="DialogCloser" id="dialog-message">
		<?php echo '<span>Вы уволены</span>'; ?>
	</div>
<?}
else if( $error == "error")
{?>
	<div class="DialogCloser" id="dialog-message">
		<?php echo '<span>Имя пользователя или пароль введены неверно!</span>'; ?>
	</div>
<?}?>

<div class="PageHeader">Введите ваши имя пользователя и пароль</div>
<form class="AuthForm"  action="" method="post">
	<div class="AuthFormArea">	
		<div class="TitledTextboxArea">
			<label for="username">Имя пользователя:</label><br>
			<input type="text" class="ProfileTextBox" size="25" maxlength="16" name="login"  id="login" value=""/>
		</div>
		<div class="TitledTextboxArea">
			<label for="password">Пароль:</label><br>
			<input type="password" class="ProfileTextBox" size="25" maxlength="16" name="password" id="password"/>
		</div>	
	</div>
	<div class="AuthFormBottom">
		<input type="submit" class="FormBut" id="submit" value="Войти" name="subm" />
	</div>				
</form>
