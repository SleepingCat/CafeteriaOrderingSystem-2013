<?php defined('SYSPATH') or die('No direct script access.');
class Model_Menu
{
	public $menu_id;
	
	public function get_menu_id($date = NULL)
	{
		if ($date != null)
		{
			$this->menu_id = DB::query(Database::SELECT, 'SELECT menu_id FROM menus WHERE menu_date =:date')
			->param(':date', $date)
			->execute()
			->as_array();		
		}
		return $this->menu_id;
	}
	
	public function get_menu($date)
	{
		$id = $this->get_menu_id($date)[0];
		if (empty($id))
		{
			return null;
		}
		else 
		{
			return DB::query(Database::SELECT, 
				'SELECT menu_id, dishes.dish_id, dish_name, type, price, is_standart 
				FROM menu_records, dishes
				WHERE (dishes.dish_id = menu_records.dish_id) 
				and (menu_records.menu_id = :MenuId)
				ORDER BY type desc')
				->param(':MenuId', $id)
				->execute()
				->as_array('dish_id');
		}
	}
}