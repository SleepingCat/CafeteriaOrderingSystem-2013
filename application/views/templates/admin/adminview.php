<?php defined('SYSPATH') or die('No direct script access.');


?>
<div id="container">
	<div id="content" class="container">
		<div class="row">
            <div class="span12">                
                <div class="row-fluid">
                    <div class="span3">
                        <h3><?php echo __('Управление учетными записями пользователей') ?></h3>
                        <table class="dashboard">
                            <tr>                               
                                <td> <li class="icon-user"></i> <a href="<?php echo URL::site('/admin/users') ?>"><?php echo __('Список пользователей') ?></a><br/></li>
                                     <li class="icon-plus"></i> <a href="<?php echo URL::site('/admin/users/new') ?>"><?php echo __('Создать нового пользователя') ?></a><br/></li>
                                     <li class="icon-film"></i> <a href="<?php echo URL::site('/admin/roles') ?>"><?php echo __('Список ролей') ?></a><br/></li>
                                     <li class="icon-plus"></i> <a href="<?php echo URL::site('/admin/roles/new') ?>"><?php echo __('Новая роль') ?></a></td></li>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
		</div>

	</div>
</div>


