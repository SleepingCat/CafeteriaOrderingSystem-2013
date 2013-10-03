<?php defined('SYSPATH') or die('No direct script access.');


// Calculate variables
$pages_range = 10;
$pages_range_half = floor(10 / 2);
$page_start = ($current_page > $pages_range_half) ? $current_page - $pages_range_half : 1;
$page_start = ($current_page > $total_pages - $pages_range) ? $total_pages - $pages_range + 1 : $page_start;
$page_start = max(1, $page_start);
?>

<div class="pagination">
	<ul>
		<?php if ($first_page !== FALSE): ?>
            <li><a href="<?php echo HTML::chars($page->url($first_page)) ?>"><?php echo __('Первая') ?></a></li>
		<?php endif ?>

		<?php if ($previous_page !== FALSE): ?>
            <li class="prev"><a href="<?php echo HTML::chars($page->url($previous_page)) ?>"><?php echo __('Предыдущая') ?></a></li>
		<?php endif ?>

		<?php for ($i = $page_start; $i < $total_pages + 1 && $i < $page_start + $pages_range; $i++) : ?>
            <li<?php if ($i == $current_page) : ?> class="active"<?php endif; ?>>
	            <a href="<?php echo HTML::chars($page->url($i)) ?>"><?php echo $i ?></a>
            </li>
		<?php endfor; ?>

		<?php if ($next_page !== FALSE): ?>
            <li><a href="<?php echo HTML::chars($page->url($next_page)) ?>"><?php echo __('Вперед') ?></a></li>
		<?php endif ?>

		<?php if ($last_page !== FALSE): ?>
            <li><a href="<?php echo HTML::chars($page->url($last_page)) ?>"><?php echo __('Последняя') ?></a></li>
		<?php endif ?>
	</ul>
</div>