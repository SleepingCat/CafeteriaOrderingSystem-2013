<?php defined('SYSPATH') or die('No direct script access.');

return array(

	// Application defaults
	'admin' => array(
		'current_page'      => array('source' => 'query_string', 'key' => 'id'), // source: "query_string" or "route"
		'total_items'       => 0,
		'items_per_page'    => 10,
		'view'              => 'pagination/basic',
		'auto_hide'         => TRUE,
		'first_page_in_url' => FALSE,
	),		
);
