<?php defined('SYSPATH') or die('No direct script access.');?>


<div class="PageHeader">Список пользователей</div>

<?php if ($message <> "") {?>
	<div class="DialogCloser" id="dialog-message">
		<?php echo $message;?>
	</div>
<?};?>

<div align="right">
<form class="SearchForm"  action="<?php echo URL::site('admin/users/search') ?>" method="post">
	<div class="SearchLabel">Поиск:</div>
	<div>
		<input type="text" class="SearchTextBox" id="search" name="search"/> 
		<input type="submit" class="EntBut EntBut-color" style="width: 60px;"  id="submit" value="OK" name="submmit">
	</div>
 </form>
</div>

<div align="left" style="margin: 5px 0px 20px 40px;">
	<a href="<?php echo URL::site('/admin/users/new') ?>" id="add_user" class="EntBut EntBut-color" style="width: 200px; line-height: 30px;">
    	<span>Добавить пользователя</span>
    </a>
</div>

<table class="DataTable" style="width: 720px;">
<tr class="ColoredRow">
	<th class="DataCell DataTableHeader">Пользователь</th>    
    <th class="DataCell DataTableHeader">Данные о сотруднике</th>
    <th class="DataCell DataTableHeader">Адрес доставки</th>
</tr>
<?php if ($items->count()) : 
	foreach ($items as $item) : ?>
<tr>
	<td rowspan="2" class="DataCell" style="width: 240px">
    	<b>Имя пользователя</b>:<br>
        <?php echo $item->username ?><br>
        <b>Email:</b><br>
        <?php echo $item->email ?><br>
    </td>
    <td rowspan="2" class="DataCell">
    	<b>Табельный номер:</b> <?php echo $item->employee_number ?><br>
    	<b>ФИО:</b><br>
    	<?php echo $item->surname ?><br>
        <?php echo $item->name ?><br>
        <?php echo $item->patronymic ?><br>
    </td>
    <td class="DataCell" style="width: 210px">
    	<b>Здание:</b> <?php echo $item->building ?><br>
        <b>Этаж:</b> <?php echo $item->floor ?><br>
        <b>Кабинет:</b> <?php echo $item->office ?><br>
    </td>
</tr>
<tr>
	<td class="DataCell DataTableHeader">
    	<a href="<?php echo URL::site('admin/users/edit/' . $item->id) ?>" class="EntBut EntButLeft">
        	<span>Изменить</span>
        </a><a href="<?php echo URL::site('admin/users/delete/' . $item->id) ?>" class="EntBut EntButRight">
        	<span>Удалить</span>
        </a>
    </td>
</tr>
<?php endforeach; 
    else: ?>
	<tr>
		<td class="DataCell DataTableHeader" colspan="3">Пользователей нет</td>
	</tr>
  <?php endif; ?>
  <tr>    
    <td class="DataCell" id='pagination' colspan="2" align="left"><?php echo $pagination ?></td>
    <td class="DataCell" id='total' ><?php echo __('Всего пользователей: :count', array(':count' => $pagination->total_items)) ?></td>
   </tr>
</table>
