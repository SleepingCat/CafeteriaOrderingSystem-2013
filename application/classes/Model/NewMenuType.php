<?php defined('SYSPATH') or die('No direct script access.');

class Model_NewMenuType
{
	public function add_new_menuType($type, $priority)
	{
		$newType = DB::query(Database::INSERT, 'insert into dish_category set name = :type, priority = :prior')
		->param(':type', $type)
		->param(':prior', $priority)
		->execute();
		
		return $newType;
	}
}