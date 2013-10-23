<?php defined('SYSPATH') or die('No direct script access.');?>

<?php echo HTML::style('media/css/searchview.css') ?>

<form class="SearchForm"  action="<?php echo URL::site('admin/users/search') ?>" method="post">
	<div id="search_label"><?php echo __('Поиск:') ?></div>
	<div>
		<input type="text" class="TextBox" id="search" name="search"/> 
		<input type="submit" class="EntBut EntBut-color"  id="submit" value="OK" name="submmit">
	</div>
 </form>