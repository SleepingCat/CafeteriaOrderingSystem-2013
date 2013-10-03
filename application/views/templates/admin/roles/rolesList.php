<?php defined('SYSPATH') or die('No direct script access.');


?>
<div id="container_user">
    <div id="content" class="container_user" >
        <div class="row title">
	        <div class="span12">
                <h1 class="pull-left"><?php echo __('Список ролей') ?></h1>                
	        </div>
        </div>
	   
	    <div class="row">
		    <div class="span12">
                <table class="table_users" border=3px  >
                    <thead>
                    <tr>                      
                        <th><?php echo __('Имя') ?></th>
                        <th><?php echo __('Описание') ?></th>                       
                         <th ><?php echo __(' ') ?></th>						
                    </tr>
                    </thead>
                    <tbody>
				        <?php if ($items->count()) : ?>
						    <?php foreach ($items as $item) : ?>
	                        <tr>	                            
	                            <td><?php echo $item->name ?></td>
	                            <td><?php echo $item->description ?></td>  							
									                            
	                            <td class="actions">
		                            <div class="btn-group">
		                                <a class="btn" href="<?php echo URL::site('admin/roles/delete/' . $item->id) ?>"><i
				                                class="icon-remove"></i> <?php echo __('Удаление') ?></a>
		                                <a class="btn btn-primary" href="<?php echo URL::site('admin/roles/edit/' . $item->id) ?>"><i
				                                class="icon-edit"></i> <?php echo __('Редактирование') ?></a>
                                    </div>
	                            </td>
	                        </tr>
						    <?php endforeach; ?>
					    <?php else: ?>
		                    <tr>
		                        <td colspan="6"><?php echo __('No items') ?></td>
		                    </tr>
					    <?php endif; ?>
                    </tbody>
                    <tfoot>
	                    <tr>
	                        <td colspan="2"><?php echo $pagination ?></td>
							<td class="cell-middle"><?php echo __('Total: :count', array(':count' => $pagination->total_items)) ?></td>
	                       
	                    </tr>
                    </tfoot>
                    
                </table>
            </div>
	    </div>
    </div>
</div>