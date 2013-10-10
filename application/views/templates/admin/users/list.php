<?php defined('SYSPATH') or die('No direct script access.');

?>
 <h1 class="pull-left"><?php echo __('Список пользователей') ?></h1>    
        	
<div id="container">

    <div id="content" class="container">
      	    <div class="row">
		    <div class="span12">
               <table class="table table-bordered table-hover"  >
                    <thead>                    
                    <tr>                      
                        <td><?php echo __('Пользователь') ?></td>
                        <td><?php echo __('Email') ?></td>    
						<td><?php echo __('Имя') ?></td>  
						<td><?php echo __('Фамилия') ?></td> 
						<td><?php echo __('Отчество') ?></td> 
						<td><?php echo __('Здание') ?></td> 
						<td><?php echo __('Этаж') ?></td> 
						<td><?php echo __('Номер кабинета') ?></td> 
						<td><?php echo __('Табельный номер') ?></td>						
                         <td ><?php echo __('Действие') ?></td>						
                    </tr>
                    </thead>
                    <tbody>
				        <?php if ($items->count()) : ?>
						    <?php foreach ($items as $item) : ?>
	                        <tr>	                            
	                            <td><?php echo $item->username ?></td>
	                            <td><?php echo $item->email ?></td>  	
								<td><?php echo $item->name ?></td> 
								<td><?php echo $item->surname ?></td>  	
				                <td><?php echo $item->patronymic ?></td> 
							    <td><?php echo $item->building ?></td> 
						        <td><?php echo $item->floors ?></td>					       
								<td><?php echo $item->number ?></td> 
							    <td><?php echo $item->personnel_number ?></td> 
									                            
	                            <td class="actions">
		                            <div class="btn-group">
		                                <a class="btn" href="<?php echo URL::site('admin/users/delete/' . $item->id) ?>"><i
				                                class="icon-remove"></i> <?php echo __('Удаление') ?></a>
		                                <a class="btn btn-primary" href="<?php echo URL::site('admin/users/edit/' . $item->id) ?>"><i
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
	                        <td colspan="9"><?php echo $pagination ?></td>
							
	                        <td class="cell-middle"><?php echo __('Всего пользователей: :count', array(':count' => $pagination->total_items)) ?></td>
	                    </tr>
                    </tfoot>
                </table>
            </div>
	    </div>
    </div>
</div>


