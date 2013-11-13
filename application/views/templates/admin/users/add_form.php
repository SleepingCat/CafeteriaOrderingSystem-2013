<?php defined('SYSPATH') or die('No direct script access.');?>

<?php echo HTML::style('media/css/adminCSS.css'); 
 echo HTML::style('media/css/add-form.css') ?>

<form action="" method="post" name="user-form" class="MyForm">

<div class="FormTopBorder"><?php echo __('Добавление пользователя') ?></div>

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
				    <input type="text" class="TextBox" size="6" maxlength="6" name="floor" id="floor" value="<?php echo Arr::get($item, 'floor') ?>"/>
				</div>
				<div class="TitledTextboxArea InlineBlockClass">
				    <?php echo __('Номер кабинета:') ?><br>
				    <input type="text" class="TextBox" size="16" maxlength="6" name="office" id="number" value="<?php echo Arr::get($item, 'office') ?>"/>
				</div>
			</fieldset></td>
			<td class="Field3" rowspan="2">
			<fieldset class="Fieldset"><legend>Роли</legend>
				<?php foreach ($roles as $role) : ?>
					<label>
						<input type="checkbox" name="roles[]" id="role<?php echo $role->id ?>" value="<?php echo $role->id ?>"
							<?php if (in_array($role->id, Arr::get($item, 'roles',array()))) : ?> checked="checked" <?php endif ?>
						/><?php if($role->name=='admin') {echo $role->name='Администратор';} else {echo $role->name;} ?>   
					</label>					
					<br />
				<?php endforeach; ?>					 
			</fieldset>
			</td>
			</tr>
			<tr>
			<td class="Field" align="center">				
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
	<input type="submit" class="EntBut EntBut-color" name="subm"  id="input" value="<?php echo __('Сохранить') ?>" />
    <input type="submit" class="EntBut EntBut-color" name="back" id="cancel" value="<?php echo __('Отмена') ?>" />
</div>		
		<input type="hidden" name="email_old" value="<?php echo Arr::get($item, 'email') ?>"/>
		<input type="hidden" name="username_old" value="<?php echo Arr::get($item, 'username') ?>"/>
        <input type="hidden" name="id" value="<?php echo Arr::get($item, 'id') ?>">	
        <input type="hidden" name="employee_number_old" value="<?php echo Arr::get($item, 'employee_number') ?>"/>
        <input id="UserStatus" type="hidden" name="UserStatus" value="0">	
</form>


<!-- 
<form action="" method="post" name="user-form" class="user-form"> 
<h3 class="pull-left"><?php echo __('Добавление пользователя') ?></h3>   
          
			        <label for="email" class="control-label"><?php echo __('Email') ?>:</label>
                    <div class="controls">
		                <input type="text" name="email" id="email" value="<?php echo Arr::get($item, 'email') ?>"/>
	                    <?php if (Arr::get($errors, 'email')) : ?>
                            <div class="help-block"><?php echo Arr::get($errors, 'email') ?></div>
	                    <?php endif; ?>
	                    <input type="hidden" name="email_old" value="<?php echo Arr::get($item, 'email') ?>"/>
	                </div> 	        
			        <label for="surname" class="control-label"><?php echo __('Фамилия') ?>:</label>
                    <div class="controls">
		                <input type="text" name="surname" id="surname" value="<?php echo Arr::get($item, 'surname') ?>"/>
	                    <?php if (Arr::get($errors, 'email')) : ?>
                            <div class="help-block"><?php echo Arr::get($errors, 'surname') ?></div>
	                    <?php endif; ?>	                    
	                </div> 
					
			        <label for="name" class="control-label"><?php echo __('Имя') ?>:</label>
                    <div class="controls">
		                <input type="text" name="name" id="name" value="<?php echo Arr::get($item, 'name') ?>"/>
	                    <?php if (Arr::get($errors, 'name')) : ?>
                            <div class="help-block"><?php echo Arr::get($errors, 'name') ?></div>
	                    <?php endif; ?>	                    
	                </div>	         
			        <label for="patronymic" class="control-label"><?php echo __('Отчество') ?>:</label>
                    <div class="controls">
		                <input type="text" name="patronymic" id="patronymic" value="<?php echo Arr::get($item, 'patronymic') ?>"/>
	                    <?php if (Arr::get($errors, 'patronymic')) : ?>
                            <div class="help-block"><?php echo Arr::get($errors, 'patronymic') ?></div>
	                    <?php endif; ?>	                    
	                
	            	</div>
	            	
	            	
			        <label for="building" class="control-label"><?php echo __('Здание') ?>:</label>
                    <div class="controls">
		                <input type="text" name="building" id="building" value="<?php echo Arr::get($item, 'building') ?>"/>
	                    <?php if (Arr::get($errors, 'building')) : ?>
                            <div class="help-block"><?php echo Arr::get($errors, 'building') ?></div>
	                    <?php endif; ?>	                    
	                </div>           	
	            	
	            	
			        <label for="floors" class="control-label"><?php echo __('Этаж') ?>:</label>
                    <div class="controls">
		                <input type="text" name="floors" id="floors" value="<?php echo Arr::get($item, 'floors') ?>"/>
	                    <?php if (Arr::get($errors, 'building')) : ?>
                            <div class="help-block"><?php echo Arr::get($errors, 'floors') ?></div>
	                    <?php endif; ?>	                    
	                </div>
	            	
	            	
	           			        <label for=""num_office"" class="control-label"><?php echo __('Номер кабинета') ?>:</label>
                    <div class="controls">
		                <input type="text" name="num_office" id=""num_office"" value="<?php echo Arr::get($item, 'num_office') ?>"/>
	                    <?php if (Arr::get($errors, 'num_office')) : ?>
                            <div class="help-block"><?php echo Arr::get($errors, 'num_office') ?></div>
	                    <?php endif; ?>	                    
	                </div>
	            	
	            	
	            	<label for="personnel_number" class="control-label"><?php echo __('Табельный номер') ?>:</label>
                    <div class="controls">
		               		<input type="text" name="employee_number" value="<?php echo Arr::get($item, 'employee_number') ?>"/>
						 <?php if (Arr::get($errors, 'employee_number')) : ?>
                            <div class="help-block"><?php echo Arr::get($errors, 'employee_number') ?></div>
	                    <?php endif; ?></td>
	                    <input type="hidden" name="employee_number_old" value="<?php echo Arr::get($item, 'employee_number') ?>"/>                 
	                </div>	            					

              <label for="username" class="control-label"><?php echo __('Логин') ?>:</label>
	                <div class="controls">	                
	                  <input type="text" name="username"  id="username" value="<?php echo Arr::get($item, 'username') ?>"/>
	                <input type="hidden" name="username_old" value="<?php echo Arr::get($item, 'username') ?>"/>	                  
						<?php if (Arr::get($errors, 'username')) : ?>
							<div class="help-block"><?php echo Arr::get($errors, 'username') ?></div>
						<?php endif; ?>
	                </div>  
	                
	                  <label for="password" class="control-label"><?php echo __('Пароль') ?>:</label>
                    <div class="controls">
		                <input type="password" name="password" id="password"/>
	                    <?php if (Arr::get($errors, 'password')) : ?>
                            <div class="help-block"><?php echo Arr::get($errors, 'password') ?></div>
	                    <?php endif; ?>
                    </div> 
               
		            <label for="password_confirm" class="control-label"><?php echo __('Подтвердите пароль') ?>:</label>
                    <div class="controls">
		                <input type="password" name="password_confirm" id="password_confirm"/>
	                    <?php if (Arr::get($errors, 'password_confirm')) : ?>
                            <div class="help-block"><?php echo Arr::get($errors, 'password_confirm') ?></div>
	                    <?php endif; ?>
                    </div> 
	    			
	    			<br>
	    <div class="span3"  align=center>
	              <legend><?php echo __('Выберите роль') ?></legend>
		        <div class="control-group">
			        <label class="control-label"><?php echo __('Роли:') ?></label>
					<?php foreach ($roles as $role) : ?>
					    <label class="checkbox">
							<?php echo $role->name ?>
					        <input id="role<?php echo $role->id ?>" type="checkbox" name="roles[]" value="<?php echo $role->id ?>"
								<?php if (in_array($role->id, Arr::get($item, 'roles',array()))) : ?> checked="checked" <?php endif ?>/>
					    </label>
			        <?php endforeach; ?>
		        </div>	       
	    		</div>
	    		    		
	<div class="row">
		<div class="span12 form-actions">
            <div class="pull-right">
            	<input type="submit" name="subm"  id="input" class="btn btn-primary" value="<?php echo __('Сохранить') ?>" />
                <input type="submit" name="back" id="cancel" class="btn" value="<?php echo __('Отмена') ?>" />                
            </div>
		</div>
		<input id="UserStatus" type="hidden" name="UserStatus" value="0">
	</div>
</form>

 -->