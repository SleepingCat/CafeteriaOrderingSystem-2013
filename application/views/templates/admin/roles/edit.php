<?php defined('SYSPATH') or die('No direct script access.');


?>

<div id="container">
    <div id="content" class="container">
        <div class="row title">
	        <div class="span12">
                <h1 class="pull-left"><?php echo __('Редактирование роли: :role', array(':role' => Arr::get($item, 'name'))) ?></h1>
	        </div>
        </div>

        <?php echo View::factory('templates/admin/roles/form', array('item' => $item,'errors'=>$errors  )) ?>
    </div>
</div>


