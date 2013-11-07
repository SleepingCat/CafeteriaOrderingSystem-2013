<?php defined('SYSPATH') or die('No direct script access.');
//
//@autor = MrAnderson;
//
//
class Model_Reestr extends Model
{
	public function get_all_dishes()
	{
		$query = 'select dishes.dish_id, dishes.dish_name, dishes.is_available as is_available, dishes.is_standart as is_standart ,dish_type.name as type ,dish_category.name as category
					from dishes, dish_type, dish_category
					where (dishes.dish_type_id = dish_type.id) and (dishes.dish_category_id = dish_category.id)';
		
		$reestr = DB::query(Database::SELECT, $query) ->execute() ->as_array('dish_id');
		
		foreach ($reestr as $key=>$value)
		{
			$reestr[$key]['ingredients'] = $this->get_ingredients($key);
			
		}
		
		
				
		return $reestr;
	}
	
 public	function get_ingredients($dish_id)
	{
		$query ='select ingredients.product_id , product_name 
				from ingredients, products
				where (ingredients.dish_id = :dish_id) 
						and (ingredients.product_id = products.product_id )';
		
		return DB::query(Database::SELECT, $query)->param(':dish_id', $dish_id) ->execute() ->as_array('product_id');
		
	}
	
	public function get_portions($dish_id)
	{
		$query = 'select dish_portion.portion_type_id, type_name
					from dish_portion, portion_type
					where (dish_portion.dish_id = :dish_id)
					and (dish_portion.portion_type_id = portion_type.id)';
		return DB::query(Database::SELECT, $query)->param(':dish_id', $dish_id) ->execute() ->as_array('portion_type_id');
	}
	
	public  function get_categories()
	{
		
		return DB::query(Database::SELECT, "select * from dish_category") ->execute() ->as_array('id');
		
	}
	
	public  function get_types()
	{
	
		return DB::query(Database::SELECT, "select * from dish_type") ->execute() ->as_array('id');
	
	}
	
	public function get_ingredient()
	{
		return DB::query(Database::SELECT, "select * from products") ->execute()->as_array('product_id');
	}
	
	public function delete_dish($dish_id)
	{
		$query = 'UPDATE  dishes SET  `is_available` = NULL WHERE  dish_id =:dish_id;';
		return DB::query(Database::UPDATE, $query)->param(':dish_id', $dish_id)->execute();
	}
	
	
	
	public function update_dish($dish_id)
	{
		
	}
	
	public function find_category($category_name)
	{
		
	}
	
	public function find_type($type_name)
	{
		
	}
	
	public function find_ingredients($ingridient_name)
	{
		
	}
	
}
