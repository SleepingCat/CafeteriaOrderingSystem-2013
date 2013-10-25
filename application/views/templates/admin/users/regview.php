<?php defined('SYSPATH') or die('No direct script access.');

?>    
<form action="<?php echo URL::site('/Userprofile/saveprofile') ?>" method="post">
				<table class="login">
					<tr >
						<h3><td colspan="2"  style="padding-bottom:10px; font-size:20px; font-weight: bolder; text-align:right; ">Профиль клиента</td></h3>
					</tr>
					<tr>
						<td style="text-align:right;">Логин:</td>
						<td><input type="text" name="username" value="<?php echo Arr::get($item, 'username') ?>"/>
						<?php if (Arr::get($errors, 'username')) : ?>
                            <div class="help-block"><?php echo Arr::get($errors, 'username') ?></div>
	                    <?php endif; ?>
	                    	<input type="hidden" name="username_old" value="<?php echo Arr::get($item, 'username') ?>"/>
						 </td>									
					</tr>
					
					<tr>
						<td style="text-align:right;">Старый пароль:</td>
						<td><input type="password_old" name="password_old" id="password_old"/>						
						 <?php if (Arr::get($errors, 'password_old')) : ?>
                            <div class="help-block"><?php echo Arr::get($errors, 'password_old') ?></div>
	                    <?php endif; ?></td>	
						                    
					</tr>
					<tr>
						<td style="text-align:right;">Пароль:</td>
						<td><input type="password" name="password" id="password"/>
						 <?php if (Arr::get($errors, 'password')) : ?>
                            <div class="help-block"><?php echo Arr::get($errors, 'password') ?></div>
	                    <?php endif; ?></td>	                   
					</tr>
					
					<tr>
						<td style="text-align:right;">E-mail:</td>
						<td><input type="text" name="email" id="email" value="<?php echo Arr::get($item, 'email') ?>"/>
						 <?php if (Arr::get($errors, 'email')) : ?>
                            <div class="help-block"><?php echo Arr::get($errors, 'email') ?></div>                            
	                    <?php endif; ?></td>	
	                     <td><input type="hidden" name="email_old" id="email" value="<?php echo Arr::get($item, 'email') ?>"/>                   
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
						<td><input type="text" name="floor" value="<?php echo Arr::get($item, 'floor') ?>"/>
						 <?php if (Arr::get($errors, 'floor')) : ?>
                            <div class="help-block"><?php echo Arr::get($errors, 'floor') ?></div>
	                    <?php endif; ?></td>
					</tr>
					
					<tr>
						<td style="text-align:right;">Номер кабинета:</td>
						<td><input type="text" name="office" value="<?php echo Arr::get($item, 'office') ?>"/>
						 <?php if (Arr::get($errors, 'office')) : ?>
                            <div class="help-block"><?php echo Arr::get($errors, 'office') ?></div>
	                    <?php endif; ?></td>
					</tr>
					
					<tr>
						<td style="text-align:right;">Табельный номер:</td>
						<td><input type="text" name="employee_number1" disabled=true value="<?php echo Arr::get($item, 'employee_number') ?>"/>
						 <?php if (Arr::get($errors, 'employee_number')) : ?>
                            <div class="help-block"><?php echo Arr::get($errors, 'employee_number') ?></div>
	                    <?php endif; ?>
	                      <input type="hidden" name="employee_number"  value="<?php echo Arr::get($item, 'employee_number') ?>"/>
	                      <input type="hidden" name="employee_number_old" value="<?php echo Arr::get($item, 'employee_number') ?>"/>  </td>
					</tr>
					
					<tr>
						<td style="text-align:right;">Оплата заказа  удержанием из зарплаты:</td>
						<td style="text-align:left;">Да:<input type="radio" name="payment_type" value="1" 
						<?php if ( Arr::get($item, 'payment_type')==1 ) : ?> checked="checked" <?php endif ?>/>	
						Нет:<input type="radio" name="payment_type" value="0"
						 <?php if ( Arr::get($item, 'payment_type')==0 ) : ?> checked="checked" <?php endif ?>/>					 
	                   </td>
					</tr>
					
					<th colspan="2" style="text-align:right"><input type="submit" value="OK" style="width:170px; height:30px" name="subm"></th>
				</table>
				
				 <input type="hidden" name="id" value="<?php echo Arr::get($item, 'id') ?>">
				
                            
		       
	    </form>
