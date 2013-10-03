<?if(isset($regok)){?>
	<p style="text-align:center; color:green;">
		Регистрация прошла успешно
	</p>
<?}?>

<form action="" method="post">
				<table class="login">
					<tr>
						<th colspan="2" style="padding-bottom:10px;">Регистрация пользователя</th>
					</tr>
					<tr>
						<td>Логин:</td>
						<td><input type="text" name="username" />
						 <?php if (Arr::get($errors, 'username')) : ?>
                            <div class="help-block"><?php echo Arr::get($errors, 'username') ?></div>
	                    <?php endif; ?></td>																		
					</tr>				

					<tr>
						<td>Пароль:</td>
						<td><input type="password" name="password" id="password"/>
						 <?php if (Arr::get($errors, 'password')) : ?>
                            <div class="help-block"><?php echo Arr::get($errors, 'password') ?></div>
	                    <?php endif; ?></td>	                   
					</tr>
					<tr>
						<td style="text-align:right;">Эл. почта:</td>
						<td><input type="text" name="email" />
						 <?php if (Arr::get($errors, 'email')) : ?>
                            <div class="help-block"><?php echo Arr::get($errors, 'email') ?></div>
	                    <?php endif; ?></td>					</tr>
					
					<th colspan="2" style="text-align:right"><input type="submit" value="OK" style="width:170px; height:30px" name="subm"></th>
				</table>
							      
	           
		        <div class="span3" align="center" >
	       
	            <legend><?php echo __('Роли пользователя:') ?></legend>
		        <div class="control-group">
			        <label class="control-label"><?php echo __('Выберите роли:') ?></label>
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
</form>
