<?php defined('SYSPATH') or die('No direct script access.');

?>
<form action="" method="post" name="user-form" class="user-form"> 
<h3 class="pull-left"><?php echo __('Добавление пользователя') ?></h1>   
                
                <div class="control-group<?php if (Arr::get($errors, 'username')) : ?> error<?php endif; ?>">
		            <label for="username" class="control-label"><?php echo __('Логин') ?>:</label>
	                <div class="controls">
	                		<input type="hidden" name="username_old" value="<?php echo Arr::get($item, 'username') ?>"/>
	                    <input type="text" name="username"  id="username" value="<?php echo Arr::get($item, 'username') ?>"/>
						<?php if (Arr::get($errors, 'username')) : ?>
							<div class="help-block"><?php echo Arr::get($errors, 'username') ?></div>
						<?php endif; ?>
	                </div>
	            

                <div class="control-group<?php if (Arr::get($errors, 'email')) : ?> error<?php endif; ?>">
			        <label for="email" class="control-label"><?php echo __('Email') ?>:</label>
                    <div class="controls">
		                <input type="text" name="email" id="email" value="<?php echo Arr::get($item, 'email') ?>"/>
	                    <?php if (Arr::get($errors, 'email')) : ?>
                            <div class="help-block"><?php echo Arr::get($errors, 'email') ?></div>
	                    <?php endif; ?>
	                    <input type="hidden" name="email_old" value="<?php echo Arr::get($item, 'email') ?>"/>
	                </div>
	            </div>
	            
	            <div class="control-group<?php if (Arr::get($errors, 'surname')) : ?> error<?php endif; ?>">
			        <label for="surname" class="control-label"><?php echo __('Фамилия') ?>:</label>
                    <div class="controls">
		                <input type="text" name="surname" id="surname" value="<?php echo Arr::get($item, 'surname') ?>"/>
	                    <?php if (Arr::get($errors, 'email')) : ?>
                            <div class="help-block"><?php echo Arr::get($errors, 'surname') ?></div>
	                    <?php endif; ?>	                    
	                </div>
	            </div>
					
					<div class="control-group<?php if (Arr::get($errors, 'name')) : ?> error<?php endif; ?>">
			        <label for="name" class="control-label"><?php echo __('Имя') ?>:</label>
                    <div class="controls">
		                <input type="text" name="name" id="name" value="<?php echo Arr::get($item, 'name') ?>"/>
	                    <?php if (Arr::get($errors, 'name')) : ?>
                            <div class="help-block"><?php echo Arr::get($errors, 'name') ?></div>
	                    <?php endif; ?>	                    
	                </div>
	            	</div>
	            
	            <div class="control-group<?php if (Arr::get($errors, 'patronymic')) : ?> error<?php endif; ?>">
			        <label for="patronymic" class="control-label"><?php echo __('Отчество') ?>:</label>
                    <div class="controls">
		                <input type="text" name="patronymic" id="patronymic" value="<?php echo Arr::get($item, 'patronymic') ?>"/>
	                    <?php if (Arr::get($errors, 'patronymic')) : ?>
                            <div class="help-block"><?php echo Arr::get($errors, 'patronymic') ?></div>
	                    <?php endif; ?>	                    
	                </div>
	            	</div>
	            	
	            	<div class="control-group<?php if (Arr::get($errors, 'building')) : ?> error<?php endif; ?>">
			        <label for="building" class="control-label"><?php echo __('Здание') ?>:</label>
                    <div class="controls">
		                <input type="text" name="building" id="building" value="<?php echo Arr::get($item, 'building') ?>"/>
	                    <?php if (Arr::get($errors, 'building')) : ?>
                            <div class="help-block"><?php echo Arr::get($errors, 'building') ?></div>
	                    <?php endif; ?>	                    
	                </div>
	            	</div>
	            	
	            	<div class="control-group<?php if (Arr::get($errors, 'floors')) : ?> error<?php endif; ?>">
			        <label for="floors" class="control-label"><?php echo __('Этаж') ?>:</label>
                    <div class="controls">
		                <input type="text" name="floors" id="floors" value="<?php echo Arr::get($item, 'floors') ?>"/>
	                    <?php if (Arr::get($errors, 'building')) : ?>
                            <div class="help-block"><?php echo Arr::get($errors, 'floors') ?></div>
	                    <?php endif; ?>	                    
	                </div>
	            	</div>
	            	
	            	<div class="control-group<?php if (Arr::get($errors, 'number')) : ?> error<?php endif; ?>">
			        <label for="number" class="control-label"><?php echo __('Номер кабинета') ?>:</label>
                    <div class="controls">
		                <input type="text" name="number" id="number" value="<?php echo Arr::get($item, 'number') ?>"/>
	                    <?php if (Arr::get($errors, 'building')) : ?>
                            <div class="help-block"><?php echo Arr::get($errors, 'number') ?></div>
	                    <?php endif; ?>	                    
	                </div>
	            	</div>
	            	
	            	<label for="personnel_number" class="control-label"><?php echo __('Табельный номер') ?>:</label>
                    <div class="controls">
		               		<input type="text" name="personnel_number" value="<?php echo Arr::get($item, 'personnel_number') ?>"/>
						 <?php if (Arr::get($errors, 'personnel_number')) : ?>
                            <div class="help-block"><?php echo Arr::get($errors, 'personnel_number') ?></div>
	                    <?php endif; ?></td>
	                    <input type="hidden" name="personnel_number_old" value="<?php echo Arr::get($item, 'personnel_number') ?>"/>                 
	                </div>
	            	</div> 				

                <div class="control-group<?php if (Arr::get($errors, 'password')) : ?> error<?php endif; ?>">
		            <label for="password" class="control-label"><?php echo __('Пароль') ?>:</label>
                    <div class="controls">
		                <input type="password" name="password" id="password"/>
	                    <?php if (Arr::get($errors, 'password')) : ?>
                            <div class="help-block"><?php echo Arr::get($errors, 'password') ?></div>
	                    <?php endif; ?>
                    </div>
                </div>
                
                <div class="control-group<?php if (Arr::get($errors, 'password_confirm')) : ?> error<?php endif; ?>">
		            <label for="password_confirm" class="control-label"><?php echo __('Подтвердите пароль') ?>:</label>
                    <div class="controls">
		                <input type="password" name="password_confirm" id="password_confirm"/>
	                    <?php if (Arr::get($errors, 'password_confirm')) : ?>
                            <div class="help-block"><?php echo Arr::get($errors, 'password_confirm') ?></div>
	                    <?php endif; ?>
                    </div> 
	    			</div>
	    			<br>
	    <div class="span3"  align=center>
	              <legend><?php echo __('Выберите роль') ?></legend>
		        <div class="control-group">
			        <label class="control-label"><?php echo __('Roles') ?></label>
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
                <input type="submit" name="back" class="btn" value="<?php echo __('Отмена') ?>" />
                <input type="submit" name="subm"  id="input1" class="btn btn-primary" value="<?php echo __('Сохранить') ?>" />
            </div>
		</div>

        <input type="hidden" name="id" value="<?php echo Arr::get($item, 'id') ?>">
	</div>
</form>