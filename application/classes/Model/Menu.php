<?php defined('SYSPATH') or die('No direct script access.');

/**
 * @author Kenny
 * Модель меню содержит методы для получения самого меню или сведений о меню
 */
class Model_Menu
{
	public $menu_id;
	
	function get_menu_list()
	{
		if(date("H")>14)
		{
			$yd = date("Y-m-d");
		}
		else
		{
			$yd = date("Y-m-d", strtotime('-1 day'));
		}
		return DB::query(Database::SELECT, 'SELECT menu_id, menu_date FROM menus WHERE menu_date > :date')
		->param(':date', $yd)
		->execute()
		->as_array();
		
	}
	
	/**
	 * Возвращает Id меню за конкретную дату
	 * @param $date - дата, за которую требуется вывести меню
	 * @return null|int
	 */
	public function get_menu_id($date = NULL)
	{
		if ($date != null)
		{
			$this->menu_id = DB::query(Database::SELECT, 'SELECT menu_id FROM menus WHERE menu_date =:date LIMIT 1')
			->param(':date', $date)
			->execute()
			->as_array();
		}
		return $this->menu_id;
	}
	
	public function get_portions($menuId,$dishId)
	{
		
		$price = DB::query(Database::SELECT, 
					'SELECT price
					FROM menu_records
					WHERE 
					menu_records.menu_id = :MenuId
					AND menu_records.dish_id = :DishId
					')
				->param(':MenuId', $menuId)
				->param(':DishId', $dishId)
				->execute()
				->as_array();
		return Array( 	
						2 => Array('portion_type_id' => 2, 'type_name' => 'Стандартная', 'size' => 1, 'price' => $price[0]['price']),
						1 => Array('portion_type_id' => 1, 'type_name' => 'Половинная', 'size' => 0.5, 'price' => $price[0]['price']*0.5 ),
						3 => Array('portion_type_id' => 3, 'type_name' => 'Двойная', 'size' => 2, 'price' => $price[0]['price']*2 )
				);
	}
	
	/**
	 * Возвращает меню за конкретную дату или null в случае отсутствия данного меню
	 * @param $date - дата, за которую требуется вывести меню
	 * @return NULL|array
	 */
	public function get_menu($date)
	{
		$id = $this->get_menu_id($date);
		if (empty($id))
		{
			return null;
		}
		else 
		{	
			$id = $id[0];
			$result = DB::query(Database::SELECT, 
				'SELECT menu_id, dishes.dish_id, dish_name, price, dish_category.`name` as type, priority, portion_type_id
				FROM menu_records, dishes, dish_category
				WHERE (dishes.dish_id = menu_records.dish_id) 
				and (dishes.dish_category_id = dish_category.id)
				and (menu_records.menu_id = :MenuId)
				ORDER BY priority
					')
				->param(':MenuId', $id)
				->execute()
				->as_array('dish_id');
			foreach ($result as $key => $value)
			{
				$result[$key]['portions'] = $this->get_portions($id,$key);
			}
			return $result;
		}
	}
}