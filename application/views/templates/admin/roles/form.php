<?php defined('SYSPATH') or die('No direct script access.');


?>
<form action="<?php echo URL::site('/admin/roles/save') ?>" method="post" name="role-form" class="role-form">
    <div class="row">
		<div class="span12">
            <div class="control-group<?php if (Arr::get($errors, 'name')) : ?> error<?php endif; ?>">
                <label for="name" class="control-label"><?php echo __('Имя роли') ?>:</label>

                <div class="controls">
                    <input type="text" name="name" id="name" value="<?php echo Arr::get($item, 'name') ?>"/>
					<?php if (Arr::get($errors, 'name')) : ?>
                        <div class="help-block"><?php echo Arr::get($errors, 'name') ?></div>
					<?php endif; ?>
                </div>
            </div>

            <div class="control-group<?php if (Arr::get($errors, 'description')) : ?> error<?php endif; ?>">
                <label for="description" class="control-label"><?php echo __('Описание') ?>:</label>

                <div class="controls">
                    <textarea rows="5" cols="50" name="description"  
                              id="description" >  <?php echo HTML::entities(Arr::get($item, 'description')) ?> </textarea>
					<?php if (Arr::get($errors, 'description')) : ?>
                        <div class="help-block"><?php echo Arr::get($errors, 'description') ?></div>
					<?php endif; ?>
                </div>
            </div>
	    </div>
	</div>
	<div class="row">
		<div class="span12">
            <div class="form-actions">
	            <div class="pull-right">
                    <input type="submit" name="back" class="btn" value="<?php echo __('Назад') ?>" />
                    <input type="submit" name="save" class="btn btn-primary" value="<?php echo __('Сохранить') ?>" />
	            </div>
            </div>
		</div>

        <input type="hidden" name="id" value="<?php echo Arr::get($item, 'id') ?>">
	</div>
</form>