<?php defined('SYSPATH') or die('No direct access allowed.');

return array(

	'driver'       => 'ORM',
	'hash_method'  => 'sha256',
	'hash_key'     => '2,4,6,7,9,15,20,23,25,30',
	'lifetime'     => 1209600,
	'session_type' => Session::$default,
	'session_key'  => 'auth_user',

	// Username/password combinations for the Auth File driver
	'users' => array(
		// 'admin' => 'a13de8d3294a909283ad79e7bf7ba631d87b5b47bdbff1dec8238e6a7ef16d53',
	),

);
