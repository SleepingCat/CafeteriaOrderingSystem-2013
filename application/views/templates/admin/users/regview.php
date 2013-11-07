<?php defined('SYSPATH') or die('No direct script access.');?>

<?php echo HTML::style('media/css/adminCSS.css'); 
 echo HTML::style('media/css/add-form.css') ?>

<form action="<?php echo URL::site('/Userprofile/saveprofile') ?>" method="post" name="user-form" class="MyForm">

<div class="FormTopBorder"><?php echo __('Профиль клиента: :user', array(':user' => Arr::get($item, 'username'))) ?></div>

<div class="FormArea">
	<table>
		<tr>
			<td class="Field">
			<fieldset class="Fieldset"><legend>Профиль</legend>			
			    <div class="TitledTextboxArea">
			        <?php echo __('Имя пользователя:') ?><br>
			        <input type="text" class="TextBox" size="25" maxlength="16" name="username"  id="username" value="<?php echo Arr::get($item, 'username') ?>"/>
			    </div>
			    <div class="TitledTextboxArea">
			        <?php echo __('Email:') ?><br>
			        <input type="text" class="TextBox" size="25" maxlength="25"  name="email" id="email" value="<?php echo Arr::get($item, 'email') ?>"/>
			    </div>
			    <div class="TitledTextboxArea">
			        <?php echo __('Пароль:') ?><br>
			        <input type="password" class="TextBox" size="25" maxlength="16" name="password" id="password"/>
			    </div>
			    <div class="TitledTextboxArea">
			        <?php echo __('Введите старый пароль:') ?><br>
			        <input type="password" class="TextBox" size="25" maxlength="16" name="password_old" id="password_confirm"/>
			    </div>			    
			
			</td><td class="Field">
			<fieldset class="Fieldset"><legend>Личные данные</legend>
				<div class="TitledTextboxArea">
				    <?php echo __('Табельный номер:') ?><br>
				    <input type="text" class="TextBox" size="6" maxlength="6" name="employee_number1" disabled=true value="<?php echo Arr::get($item, 'employee_number') ?>"/>
				  <input type="hidden" class="TextBox" size="6" maxlength="6" name="employee_number" value="<?php echo Arr::get($item, 'employee_number') ?>"/>
				</div>
				<div class="TitledTextboxArea">
				    <?php echo __('Фамилия:') ?><br>
				    <input type="text" class="TextBox" size="25" maxlength="25" name="surname" id="surname" value="<?php echo Arr::get($item, 'surname') ?>"/>
				</div>
				<div class="TitledTextboxArea">
				    <?php echo __('Имя:') ?><br>
				    <input type="text" class="TextBox" size="25" maxlength="25" name="name" id="name" value="<?php echo Arr::get($item, 'name') ?>"/>
				</div>
				<div class="TitledTextboxArea">
				    <?php echo __('Отчество:') ?><br>
				    <input type="text" class="TextBox" size="25" maxlength="25" name="patronymic" id="patronymic" value="<?php echo Arr::get($item, 'patronymic') ?>"/>
				</div>
			</fieldset></td>
		</tr>
	</table>
	<table>
		<tr>
			<td class="Field2">
			<fieldset class="Fieldset"><legend>Адрес доставки по умолчанию</legend>
				<div class="TitledTextboxArea InlineBlockClass">
				    <?php echo __('Здание:') ?><br>
				    <input type="text" class="TextBox" size="6" maxlength="6" name="building" id="building" value="<?php echo Arr::get($item, 'building') ?>"/>
				</div>
				<div class="TitledTextboxArea InlineBlockClass">
				    <?php echo __('Этаж:') ?><br>
				    <input type="text" class="TextBox" size="6" maxlength="6" name="floor" id="floor" value="<?php echo Arr::get($item, 'floor') ?>"/>
				</div>
				<div class="TitledTextboxArea InlineBlockClass">
				    <?php echo __('Номер кабинета:') ?><br>
				    <input type="text" class="TextBox" size="16" maxlength="6" name="office" id="number" value="<?php echo Arr::get($item, 'office') ?>"/>
				</div>
			</fieldset></td>
		</tr>		
		<tr>
			<td class="Field" align="center">
				<label class="FontColor">
					<?php echo __('Оплата заказа посредством удержания из зарплаты:') ?>
					<sub><input class="CheckBox" id="payment_type" type="checkbox" name="payment_type" value="1"
		    		  <?php if ( Arr::get($item, 'payment_type')==1 ) : ?> checked="checked" <?php endif ?>/>
                    </sub>
				</label>				
			</td>			
			<td></td>						
		</tr>		
</table>

<div align="left" class="FailText">	
<?if(isset($errors)){?>
<ul class="FailList">
		<?foreach($errors as $error){?>
			<li><?=$error?></li>
		<?}?>
</ul>
<?}?>	
</div>
<input type="submit" class="EntBut EntBut-color" name="subcspiction"  id="input1" value="<?php echo __('Мои заказы') ?>" />	
</div>

<div class="FormBottomBorder">
	<input type="submit" class="EntBut EntBut-color" name="save"  id="input1" value="<?php echo __('Сохранить') ?>" />
    <input type="submit" class="EntBut EntBut-color" name="back" id="cancel" value="<?php echo __('Отмена') ?>" />
</div>		
		<input type="hidden" name="email_old" value="<?php echo Arr::get($item, 'email') ?>"/>
		<input type="hidden" name="username_old" value="<?php echo Arr::get($item, 'username') ?>"/>
        <input type="hidden" name="id" value="<?php echo Arr::get($item, 'id') ?>">	
        <input type="hidden" name="employee_number_old" value="<?php echo Arr::get($item, 'employee_number') ?>"/>	
        
</form>