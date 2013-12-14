<?php defined('SYSPATH') or die('No direct script access.'); ?>

<div class="PageHeader"><?php echo __('Отчеты') ?></div>
<form class="ReportsForm" action="" method="post">
	<input type = "submit" name = "subm" class="EntBut EntBut-color" style="width: 200px; line-height: 28px; margin: 15px 0px;"
		value ="<?php echo __('Отчет по клиентам') ?>" />
	<input type = "submit" name = "food" class="EntBut EntBut-color" style="width: 200px; line-height: 28px; margin: 15px 0px;"
		value ="<?php echo __('Отчет по блюдам') ?>" />
	<input type = "submit" name = "order" class="EntBut EntBut-color" style="width: 200px; line-height: 28px; margin: 15px 0px;"
		value ="<?php echo __('Отчет по заказам') ?>" />
</form>