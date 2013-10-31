<?php defined('SYSPATH') or die('No direct script access.');
//
//@autor = MrAnderson;
//
//
class Model_Reestr extends Model
{
	public function get_all_dishes()
	{
		$query = 'select dishes.dish_id, dishes.dish_name,dish_type.name as type ,dish_category.name as category
					from dishes, dish_type, dish_category
					where (dishes.dish_type_id = dish_type.id) and (dishes.dish_category_id = dish_category.id)';
		
		$reestr = DB::query(Database::SELECT, $query) ->execute() ->as_array('dish_id');
		
		foreach ($reestr as $key=>$value)
		{
			$reestr[$key]['ingredients'] = $this->get_ingredients($key);
			$reestr[$key]['portions'] = $this->get_portions($key);
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
	
	public function delete_dish($dish_id)
	{
		$query = 'Delete from dishes where dish_id = :dish_id ';
		return DB::query(Database::DELETE, $query)->param(':dish_id', $dish_id)->execute();
	}
	
	
}
