<?php defined('SYSPATH') or die('No direct script access.');?>


<?if(Arr::flatten($errors))
{?> 
	<div class="DialogCloser" id="dialog-message">
		<?php echo '<span>Не удалось отредактировать пользователя</span>'; ?>
	</div>
<?};?>

<div class="PageHeader"><?php echo __('Редактирование пользователя:<br> :user', array(':user' => Arr::get($item, 'username'))) ?></div>

<form action="<?php echo URL::site('/admin/users/save') ?>" method="post" name="user-form" class="ProfileForm">

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
<td class="ProfileFormTableCell">
<fieldset class="ProfileFormFieldset"><legend style="cursor: default">Роли</legend>
<div style="height: 160px; padding-top: 10px;">
<?php foreach ($roles as $role) : ?>	
	<input type="checkbox" class="styled" name="roles[]" id="role<?php echo $role->id ?>" value="<?php echo $role->id ?>"
		<?php if (in_array($role->id, Arr::get($item, 'roles',array()))) : ?> checked="checked" <?php endif ?>>
	<label for="role<?php echo $role->id ?>" style="text-indent: 5px; line-height: 25px;">	
		<?php if($role->name=='admin') {echo $role->name='Администратор';} else {echo $role->name;} ?>
	</label><br>
<?php endforeach; ?>			
</div>					 
</fieldset>
</td>
</tr>
<tr>
<td class="ProfileFormTableCell" colspan="2" style="text-align: left; padding: 10px 17%;">
	<input class="styled" id="UserStatus" type="checkbox" name="user_status" value="1"
		<?php if ( Arr::get($item, 'user_status') ) : ?> checked="checked" <?php endif ?>/>
	<label for="UserStatus" style="text-indent: 5px; line-height: 25px;">
		<?php echo __('Отметить пользователя как "Уволен"') ?>			
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
