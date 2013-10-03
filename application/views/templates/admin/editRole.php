<?php defined('SYSPATH') or die('No direct script access.');


?>
<?php $errors; ?>
<div id="container">
    <div id="content" class="container">
        <div class="row title"  align="center">
	        <div class="span12">
                <h1 class="pull-left">
               <?php echo __('Редактирование роли') ?>
               </h1>  
                <br>
                 <label for="name" class="control-label"><?php echo __('Наименование') ?>:</label>
               <br>
                 <input type="text" name="name" id="name" value="<?php echo $item->name ?>"/>
               <br>
                 <label for="description" class="control-label"><?php echo __('Описание') ?>:</label>
               <br>
	             <input type="text" name="description" id="description" size = 80  value="<?php echo $item->description ?>"/> 
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

</div>