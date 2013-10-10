<?php defined('SYSPATH') or die('No direct script access.');

return array(

// Application defaults
	 // Application defaults
    'default' => array(
        'current_page'      => array('source' => 'query_string', 'key' => 'page'), // source: "query_string" or "route"
        'total_items'       => 0,
        'items_per_page'    => 10,
        'view'              => 'pagination/basic',
        'auto_hide'         => false,
        'first_page_in_url' => FALSE,
    ),

	'admin' => array(
		'current_page'      => array('source' => 'route', 'key' => 'id'), // source: "query_string" or "route"
		'total_items'       => 0,
		'items_per_page'    => 2,
		'view'              => 'templates/admin/pagination',
		'auto_hide'         => false,
		'first_page_in_url' => false,
	),

	
);
