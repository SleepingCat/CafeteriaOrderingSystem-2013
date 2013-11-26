<?php defined('SYSPATH') or die('No direct script access.');

class Model_NewDishType
{
	public function add_new_dishType($type)
	{
		$newType = DB::query(Database::INSERT, 'insert into dish_type set name = :type')
		->param(':type', $type)
		->execute();
		
		return $newType;
	}
}