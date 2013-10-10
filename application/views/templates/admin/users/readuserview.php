
<form action="<?php echo URL::site('/admin/users/save') ?>" method="post">				
				
				<table class="login">
					<tr>
						<th colspan="2" style="padding-bottom:10px;">Регистрация пользователя</th>
					</tr>
					<tr>
						<td>Логин:</td>
						<th>
						<input type="hidden" name="username_old" value="<?php echo Arr::get($item, 'username') ?>"/>
						<input type="text" name="username" value="<?php echo Arr::get($item, 'username') ?>"/>
						<?php if (Arr::get($errors, 'username')) : ?>
                            <div class="help-block"><?php echo Arr::get($errors, 'username') ?></div>					
									
	                    <?php endif; ?>						
                            
						 </th>									
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
						<td><input type="text" name="email" value="<?php echo Arr::get($item, 'email') ?>"/>
						 <?php if (Arr::get($errors, 'email')) : ?>
                            <div class="help-block"><?php echo Arr::get($errors, 'email') ?></div>
	                    <?php endif; ?>
	                    <input type="hidden" name="email_old" value="<?php echo Arr::get($item, 'email') ?>"/></td>
	                    
					</tr>					
					<tr>
						<td style="text-align:right;">Фамилия:</td>
						<td><input type="text" name="surname" value="<?php echo Arr::get($item, 'surname') ?>"/>
						 <?php if (Arr::get($errors, 'surname')) : ?>
                            <div class="help-block"><?php echo Arr::get($errors, 'surname') ?></div>
	                    <?php endif; ?></td>
					</tr>
					<tr>
						<td style="text-align:right;">Имя:</td>
						<td><input type="text" name="name" value="<?php echo Arr::get($item, 'name') ?>"/>
						 <?php if (Arr::get($errors, 'name')) : ?>
                            <div class="help-block"><?php echo Arr::get($errors, 'name') ?></div>
	                    <?php endif; ?></td>
					</tr>
					
					<tr>
						<td style="text-align:right;">Отчество:</td>
						<td><input type="text" name="patronymic" value="<?php echo Arr::get($item, 'patronymic') ?>"/>
						 <?php if (Arr::get($errors, 'patronymic')) : ?>
                            <div class="help-block"><?php echo Arr::get($errors, 'patronymic') ?></div>
	                    <?php endif; ?></td>
					</tr>
					
					<tr>
						<td style="text-align:right;">Здание:</td>
						<td><input type="text" name="building" value="<?php echo Arr::get($item, 'building') ?>"/>
						 <?php if (Arr::get($errors, 'building')) : ?>
                            <div class="help-block"><?php echo Arr::get($errors, 'building') ?></div>
	                    <?php endif; ?></td>
					</tr>
					
					<tr>
						<td style="text-align:right;">Этаж:</td>
						<td><input type="text" name="floors" value="<?php echo Arr::get($item, 'floors') ?>"/>
						 <?php if (Arr::get($errors, 'floors')) : ?>
                            <div class="help-block"><?php echo Arr::get($errors, 'floors') ?></div>
	                    <?php endif; ?></td>
					</tr>
					
					<tr>
						<td style="text-align:right;">Номер кабинета:</td>
						<td><input type="text" name="number" value="<?php echo Arr::get($item, 'number') ?>"/>
						 <?php if (Arr::get($errors, 'number')) : ?>
                            <div class="help-block"><?php echo Arr::get($errors, 'number') ?></div>
	                    <?php endif; ?></td>
					</tr>
					
					<tr>
						<td style="text-align:right;">Табельный номер:</td>
						<td><input type="text" name="personnel_number" value="<?php echo Arr::get($item, 'personnel_number') ?>"/>
						 <?php if (Arr::get($errors, 'personnel_number')) : ?>
                            <div class="help-block"><?php echo Arr::get($errors, 'personnel_number') ?></div>
	                    <?php endif; ?></td>
	                    <td><input type="hidden" name="personnel_number_old" value="<?php echo Arr::get($item, 'personnel_number') ?>"/>
					</tr>
					
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
		
        <input type="hidden" name="id" value="<?php echo Arr::get($item, 'id') ?>">
	    </div>
</form>
