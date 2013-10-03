<?php defined('SYSPATH') or die('No direct script access.');

?>

 <? /*if(isset($errors)){?>
		<?foreach($errors as $ads){?>
			<p style="color:red;"><?=$ads?></p>
		<?}?>
<?}*/?>
<form action="<?php echo URL::site('/admin/users/save') ?>" method="post" name="user-form" class="user-form">
<br>

    <div class="row" align="center" >
		<div class="span9">
	                   <div class="control-group<?php if (Arr::get($errors, 'username')) : ?> error<?php endif; ?>">
		            <label for="username" class="control-label"><?php echo __('Пользователь') ?>:</label>
	                <div class="controls">
	                    <input type="text" name="username" id="username" value="<?php echo Arr::get($item, 'username') ?>"/>
						<?php if (Arr::get($errors, 'username')) : ?>
							<div class="help-block"><?php echo Arr::get($errors, 'username') ?></div>
						<?php endif; ?>
	                </div>
	            </div>
				
                <div class="control-group<?php if (Arr::get($errors, 'email')) : ?> error<?php endif; ?>">
			        <label for="email" class="control-label"><?php echo __('Email') ?>:</label>
                    <div class="controls">
		                <input type="text" name="email" id="email" value="<?php echo Arr::get($item, 'email') ?>"/>
	                    <?php if (Arr::get($errors, 'email')) : ?>
                            <div class="help-block"><?php echo Arr::get($errors, 'email') ?></div>
	                    <?php endif; ?>
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
		<br>
	    <div class="span3">	        
	            <legend><?php echo __('Выбор ролей:') ?></legend>
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
	</div>
	<br>
	<div class="row" align="center">
		<div class="span12 form-actions">
            <div class="pull-right">
                <input type="submit" name="back" class="btn" value="<?php echo __('Вернуться') ?>" />
                <input type="submit" name="save" class="btn btn-primary" value="<?php echo __('Сохранить') ?>" />
            </div>
		</div>

        <input type="hidden" name="id" value="<?php echo Arr::get($item, 'id') ?>">
	</div>
</form>