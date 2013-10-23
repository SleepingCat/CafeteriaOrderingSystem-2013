<?php defined('SYSPATH') or die('No direct script access.');?>
<?php echo HTML::style('media/css/adminCSS.css') ?>

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
                <input type="submit" name="back" id="cancel" class="btn" value="<?php echo __('Отмена') ?>" />
                <input type="submit" name="subm"  id="input" class="btn btn-primary" value="<?php echo __('Сохранить') ?>" />
            </div>
		</div>
		<input id="UserStatus" type="hidden" name="UserStatus" value="0">
	</div>
</form>