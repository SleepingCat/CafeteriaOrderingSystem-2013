<?php defined('SYSPATH') or die('No direct script access.'); ?>

<?if( $error !="")
{?> 
	<div class="DialogCloser" id="dialog-message">
		<span><?php  echo $error ?></span>
	</div>
<?}?>

<div class="PageHeader"><?php  echo $Rep?></div>
<form class="ReportsForm" action="" method="post">
	<div class="TitledTextboxArea" style="margin: 15px 0px;">
		<label for="Start">Выберите начало периода:</label><br>
		<input type="text" name="Start" id="Start" class="ProfileTextBox" size="20" maxlength="10">
	</div>
	<div class="TitledTextboxArea" style="margin: 15px 0px;">
		<label for="End">Выберите конец периода:</label><br>
		<input type="text" name="End" id="End" class="ProfileTextBox" size="20" maxlength="10">
	</div>
	<div class="AuthFormBottom">
		<input type="submit" name="subm" id="subm" class="EntBut EntBut-color" style="width: 100px; line-height: 28px;" value="OK">
		<a href="/Reports" class="EntBut EntBut-color" style="width: 100px; line-height: 28px;">Отмена</a>		
	</div>	
</form>
