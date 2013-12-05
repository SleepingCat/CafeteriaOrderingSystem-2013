<?php defined('SYSPATH') or die('No direct script access.');?>

<?php if ($message <> "") {?>
	<div class="DialogCloser" id="dialog-message">
		<?php echo $message;?>
	</div>
<?};?>

<script type="text/javascript">
$(document).ready(function(e) 
{
	$("#payment_cell").tooltip(
	{
		content: function() 
		{		
			if (document.getElementById("payment_type").checked)
			return	"Уважаемый Клиент!<br>При отмене регистрации для оплаты посредством удержания из заработной платы <br>Вам будет недоступна доставка заказов на Ваше рабочее место (именуемое в Вашем Профиле как 'Адрес доставки'). <br>Так же в данном случае Вам будет недоступна возможность оформления Подписки на стандартные блюда.<br>Зарегистрироваться для оплаты посредством удержания из заработной платы нельзя в течение 30 дней.<p align ='center'> С уважением Администрация Cafeteria Ordering System!</p>";		
			else
			return "Уважаемый Клиент!<br> При регистрации для оплаты посредством удержания из заработной платы <br>Ваши заказы будут доставляться Вам на Ваше рабочее место (именуемое в Вашем Профиле как 'Адрес доставки').<br> Так же в данном случае Вам будет доступна возможность оформления Подписки на стандартные блюда.<br>Отменять регистрацию для оплаты посредством удержания из заработной платы нельзя в течение 30 дней.<br><p align='center'> С уважением Администрация Cafeteria Ordering System!</p>";

	    },
	    tooltipClass: "WarningTooltip",
	    track: true
	});		
});
</script>

<?if(Arr::flatten($errors))
{?> 
	<div class="DialogCloser" id="dialog-message">
		<?php echo '<span>Не удалось отредактировать пользователя</span>'; ?>
	</div>
<?};?>

<div class="PageHeader"><?php echo __('Мой профиль') ?></div>

<form action="<?php echo URL::site('/Userprofile/saveprofile') ?>" method="post" name="user-form" class="ProfileForm">

<div class="ProfileFormArea">
<table>
<tr >
<td class="ProfileFormTableCell">
    <fieldset class="ProfileFormFieldset"><legend style="cursor: default">Данные пользователя</legend>
    <div style="height: 220px">			
	    <div class="TitledTextboxArea">
	        <label for="username">Имя пользователя:</label>
	        <input type="text" class="ProfileTextBox" size="25" maxlength="16" name="username"  id="username" value="<?php echo Arr::get($item, 'username') ?>"	        
	        <?php if (Arr::get($errors, 'username'))
	        {?>
	        	style="border-color: red;"
	        	title="<?php echo Arr::get($errors, 'username') ?>"	        	        
			<?}?>
			/>
	    </div>
	    <div class="TitledTextboxArea">
	        <label for="email">Email:</label>
	        <input type="text" class="ProfileTextBox" size="25" maxlength="25"  name="email" id="email" value="<?php echo Arr::get($item, 'email') ?>"
	        <?php if (Arr::get($errors, 'email'))
	        {?>
	        	style="border-color: red;"
	        	title="<?php echo Arr::get($errors, 'email') ?>"	        	        
			<?}?>
			/>
	    </div>
	    <div class="TitledTextboxArea">
	        <label for="password">Пароль:</label>
	        <input type="password" class="ProfileTextBox" size="25" maxlength="16" name="password" id="password"
	        <?php if (Arr::get($errors, 'password'))
	        {?>
	        	style="border-color: red;"
	        	title="<?php echo Arr::get($errors, 'password') ?>"	        	        
			<?}?>
	        />
	    </div>
	    <div class="TitledTextboxArea">
	        <label for="password_confirm">Подтверждение пароля:</label>
	        <input type="password" class="ProfileTextBox" size="25" maxlength="16" name="password_confirm" id="password_confirm"
	        <?php if (Arr::get($errors, 'password_confirm'))
	        {?>
	        	style="border-color: red;"
	        	title="<?php echo Arr::get($errors, 'password_confirm') ?>"	        	        
			<?}?>
	        />
	    </div>	
    </div>		    
    </fieldset>
</td>
<td class="ProfileFormTableCell">
    <fieldset class="ProfileFormFieldset"><legend style="cursor: default">Личные данные</legend>
    <div style="height: 220px">
	    <div class="TitledTextboxArea">
	    <label for="employee_number">Табельный номер:</label>
	    <input type="text" class="ProfileTextBox" size="6" maxlength="6" name="employee_number" id="employee_number" value="<?php echo Arr::get($item, 'employee_number') ?>" 
	    <?php if (Arr::get($errors, 'employee_number'))
	        {?>
	        	style="border-color: red;"
	        	title="<?php echo Arr::get($errors, 'employee_number') ?>"	        	        
			<?}?>
	    />
	    </div>
	    <div class="TitledTextboxArea">
	    <label for="surname">Фамилия:</label>
	    <input type="text" class="ProfileTextBox" size="25" maxlength="25" name="surname" id="surname" value="<?php echo Arr::get($item, 'surname') ?>" 
	    <?php if (Arr::get($errors, 'surname'))
	        {?>
	        	style="border-color: red;"
	        	title="<?php echo Arr::get($errors, 'surname') ?>"	        	        
			<?}?>
	    />
	    </div>
	    <div class="TitledTextboxArea">
	    <label for="name">Имя:</label>
	    <input type="text" class="ProfileTextBox" size="25" maxlength="25" name="name" id="name" value="<?php echo Arr::get($item, 'name') ?>"
	    <?php if (Arr::get($errors, 'name'))
	        {?>
	        	style="border-color: red;"
	        	title="<?php echo Arr::get($errors, 'name') ?>"	        	        
			<?}?>
	    />
	    </div>
	    <div class="TitledTextboxArea">
	    <label for="patronymic">Отчество:</label>
	    <input type="text" class="ProfileTextBox" size="25" maxlength="25" name="patronymic" id="patronymic" value="<?php echo Arr::get($item, 'patronymic') ?>"
	    <?php if (Arr::get($errors, 'patronymic'))
	        {?>
	        	style="border-color: red;"
	        	title="<?php echo Arr::get($errors, 'patronymic') ?>"	        	        
			<?}?>
		/>
	    </div>
    </div>
    </fieldset>
</td>
</tr>
<tr>
<td class="ProfileFormTableCell">
	<fieldset class="ProfileFormFieldset"><legend style="cursor: default">Адрес доставки</legend>
	<div style="height: 160px">
		<div class="TitledTextboxArea">
			<label for="building">Здание:<br></label>
			<input type="text" class="ProfileTextBox" size="6" maxlength="6" name="building" id="building" value="<?php echo Arr::get($item, 'building') ?>" 
			<?php if (Arr::get($errors, 'building'))
	        {?>
	        	style="border-color: red;"
	        	title="<?php echo Arr::get($errors, 'building') ?>"	        	        
			<?}?>
			/>
		</div>
		<div class="TitledTextboxArea">
			<label for="floor">Этаж:<br></label>
			<input type="text" class="ProfileTextBox" size="6" maxlength="6" name="floor" id="floor" value="<?php echo Arr::get($item, 'floor') ?>" 
			<?php if (Arr::get($errors, 'floor'))
	        {?>
	        	style="border-color: red;"
	        	title="<?php echo Arr::get($errors, 'floor') ?>"	        	        
			<?}?>
			/>
		</div>
		<div class="TitledTextboxArea">
			<label for="number">Номер кабинета:<br></label>
			<input type="text" class="ProfileTextBox" size="16" maxlength="6" name="office" id="number" value="<?php echo Arr::get($item, 'office') ?>"
			<?php if (Arr::get($errors, 'office'))
	        {?>
	        	style="border-color: red;"
	        	title="<?php echo Arr::get($errors, 'office') ?>"	        	        
			<?}?>
			/>
		</div>
	</div>
	</fieldset>
</td>
<td class="ProfileFormTableCell" >
	<a href="<?php echo URL::site('/Order') ?>" class="EntBut EntBut-color" style="width: 200px; line-height: 30px; margin: 10px 0;">
    	<span>Мои заказы</span>
    </a><br>
    <a href="#" class="EntBut EntBut-color" style="width: 200px; line-height: 30px; margin: 10px 0;">
    	<span>Мои подписки</span>
    </a>
</td>
</tr>
<tr>
<td id="payment_cell" class="ProfileFormTableCell" colspan="2" style="text-align: left; padding: 10px 6%;">
	<input class="styled" id="payment_type" type="checkbox" name="payment_type" value="1"
		<?php if ( Arr::get($item, 'payment_type') ) : ?> checked="checked" <?php endif ?>/>
	<label for="payment_type" style="text-indent: 5px; line-height: 25px;" title="">
		<?php echo __('Оплата заказа посредством удержания из зарплаты') ?>			
	</label>
</td>
</tr>
</table>
</div>

<div class="FormBottomBorder">
	<input type="submit" class="FormBut" name="save"  id="input1" value="Сохранить" />
    <input type="submit" class="FormBut" name="back" id="cancel" value="Отмена" />
</div>		

<input type="hidden" name="email_old" value="<?php echo Arr::get($item, 'email') ?>"/>
<input type="hidden" name="username_old" value="<?php echo Arr::get($item, 'username') ?>"/>
<input type="hidden" name="id" value="<?php echo Arr::get($item, 'id') ?>">	
<input type="hidden" name="employee_number_old" value="<?php echo Arr::get($item, 'employee_number') ?>"/>

</form>