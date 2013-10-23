<?php defined('SYSPATH') or die('No direct script access.');?>

<?php echo HTML::style('media/css/adminCSS.css') ?>

 <h3><?php echo __('Управление учетными записями пользователей') ?></h3>
      <table class="dashboard">
        <tr>                               
      	 <td> <li class="icon-user"></i> <a href="<?php echo URL::site('/admin/users') ?>"><?php echo __('Список пользователей') ?></a><br/></li>
         	  <li class="icon-plus"></i> <a href="<?php echo URL::site('/admin/users/new') ?>"><?php echo __('Создать нового пользователя') ?></a><br/></li>
      	 </tr>
        </table>
           

