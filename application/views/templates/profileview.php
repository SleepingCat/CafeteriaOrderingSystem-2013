<?php defined('SYSPATH') or die('No direct script access.');?>    


<?php if (empty($user))
{?>
<div class="UserArea">
	<div class="UserHeaderArea">Вход в систему</div>
	<div class="UserWorkArea">
		<div class="UserName">Привет гость, надо бы авторизоваться</div>		
		<form action="<?php echo URL::site('auth/') ?>" method="post">
			<input type="submit"  id="input" value="Войти" name="submmit" class="RightAreaBut">
		</form>
	</div>
</div>	
<?php }
else
{?>
<div class="UserArea">
	<div class="UserHeaderArea">Вы вошли как:</div>
	<div class="UserWorkArea">
		<div class="UserName"><b><?php echo $user; ?></b></div>
		<a class="RightAreaBut" href="<?php echo URL::site('Userprofile') ?>">Мой профиль</a>
		<form action="<?php echo URL::site('auth/logout') ?>" method="post">
			<input type="submit"  id="logout" value="Выйти" name="submmit" class="RightAreaBut">
		</form>
	</div>
</div>
<?php };?>