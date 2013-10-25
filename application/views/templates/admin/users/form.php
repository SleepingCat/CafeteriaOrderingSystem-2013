<?php defined('SYSPATH') or die('No direct script access.');?>

<?php echo HTML::style('media/css/adminCSS.css'); 
 echo HTML::style('media/css/add-form.css') ?>

<form action="<?php echo URL::site('/admin/users/save') ?>" method="post" name="user-form" class="MyForm">

<div class="FormTopBorder"><?php echo __('Редактирование пользователя: :user', array(':user' => Arr::get($item, 'username'))) ?></div>

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
			        <?php echo __('Подтверждение пароля:') ?><br>
			        <input type="password" class="TextBox" size="25" maxlength="16" name="password_confirm" id="password_confirm"/>
			    </div>			    
			</fieldset>
			</td><td class="Field">
			<fieldset class="Fieldset"><legend>Личные данные</legend>
				<div class="TitledTextboxArea">
				    <?php echo __('Табельный номер:') ?><br>
				    <input type="text" class="TextBox" size="6" maxlength="6" name="employee_number" value="<?php echo Arr::get($item, 'employee_number') ?>"/>
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
				    <input type="text" class="TextBox" size="6" maxlength="6" name="floors" id="floors" value="<?php echo Arr::get($item, 'floors') ?>"/>
				</div>
				<div class="TitledTextboxArea InlineBlockClass">
				    <?php echo __('Номер кабинета:') ?><br>
				    <input type="text" class="TextBox" size="16" maxlength="6" name="num_office" id="number" value="<?php echo Arr::get($item, 'num_office') ?>"/>
				</div>
			</fieldset></td>
			<td class="Field3" rowspan="2">
			<fieldset class="Fieldset"><legend>Роли</legend>
				<?php foreach ($roles as $role) : ?>
					<label>
						<input type="checkbox" name="roles[]" id="role<?php echo $role->id ?>" value="<?php echo $role->id ?>"
							<?php if (in_array($role->id, Arr::get($item, 'roles',array()))) : ?> checked="checked" <?php endif ?>
						/><?php echo $role->name ?>
					</label>					
					<br />
				<?php endforeach; ?>					 
			</fieldset>
			</td>
			</tr>
			<tr>
			<td class="Field" align="center">
				<label class="FontColor">
					<?php echo __('Отметить пользователя как "Уволен"') ?>
					<sub><input class="CheckBox" id="UserStatus" type="checkbox" name="user_status" value="1"
		    		<?php if ( Arr::get($item, 'user_status') ) : ?> checked="checked" <?php endif ?>/></sub>
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