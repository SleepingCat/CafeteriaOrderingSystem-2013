<?php defined('SYSPATH') or die('No direct script access.');?>

<?php echo HTML::style('media/css/adminCSS.css') ?>

<div class="PageHeader"><?php echo __('Список пользователей') ?></div>

<div class="SubPageHeader">
	<div align="right">      
       <?php echo $search?> 
    </div>
    <div align="left">	
        <a href="<?php echo URL::site('/admin/users/new') ?>" id="add_user"><!-- class="EntBut EntBut-color" --> <?php echo __('Добавить пользователя') ?></a>   
    </div>            
</div>

<div align="center">
<table class="DataTable">
  <tr>
    <th scope="col" class="DataCell TabHeader"><?php echo __('Пользователь') ?></th>
    <th scope="col" class="DataCell TabHeader"><?php echo __('Email') ?></th>
    <th scope="col" class="DataCell TabHeader"><?php echo __('Фамилия') ?></th>
    <th scope="col" class="DataCell TabHeader"><?php echo __('Имя') ?></th>            
    <th scope="col" class="DataCell TabHeader"><?php echo __('Отчество') ?></th>
    <th scope="col" class="DataCell TabHeader"><?php echo __('Здание') ?></th>
    <th scope="col" class="DataCell TabHeader"><?php echo __('Этаж') ?></th>
    <th scope="col" class="DataCell TabHeader"><?php echo __('Номер кабинета') ?></th>
    <th scope="col" class="DataCell TabHeader"><?php echo __('Табельный номер') ?></th>
    <th scope="col" class="DataCell TabHeader"><?php echo __('Действие') ?></th>
  </tr>
  <tr>
  <?php if ($items->count()) : ?>
	<?php foreach ($items as $item) : ?>
    <td class="DataCell"><?php echo $item->username ?></td>
    <td class="DataCell"><?php echo $item->email ?></td>    
    <td class="DataCell"><?php echo $item->surname ?></td>
    <td class="DataCell"><?php echo $item->name ?></td>
    <td class="DataCell"><?php echo $item->patronymic ?></td>
    <td class="DataCell"><?php echo $item->building ?></td>
    <td class="DataCell"><?php echo $item->floor ?></td>
    <td class="DataCell"><?php echo $item->office ?></td>
    <td class="DataCell"><?php echo $item->employee_number ?></td>
    <td class="DataCell">
    	<div class="Double-btn">
        	<a href="<?php echo URL::site('admin/users/delete/' . $item->id) ?>" ><!--class="EntBut EntBut-color Double-btn-left"  -->
            	<?php echo __('у'/*'Удалить'*/) ?>
            </a><a href="<?php echo URL::site('admin/users/edit/' . $item->id) ?>" ><!-- class="EntBut EntBut-color Double-btn-right" -->
            	<?php echo __('р'/*'Редактировать'*/) ?>
            </a>
        </div>
    </td>
  </tr><?php endforeach; ?>
    <?php else: ?>
	<tr>
		<td class="DataCell" colspan="10"><?php echo __('Пользователей нет') ?></td>
	</tr>
  <?php endif; ?>
  <tr>    
    <td id='pagination' colspan="8" class="DataCell"><?php echo $pagination ?></td>
    <td id='total' colspan="2" class="DataCell"><?php echo __('Всего пользователей: :count', array(':count' => $pagination->total_items)) ?></td>
   </tr>
</table>
<!--   Диман !!!, в эту переменную выгружаю сообщения,не удаляй её!  -->
<?php echo $message ?>

</div> 
