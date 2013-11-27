<?php defined('SYSPATH') or die('No direct script access.');

class Model_DelTypeMenuDishIngr
{
	public function del_ingr($id)
	{
		$del = DB::query(Database::DELETE, 'DELETE FROM products where product_id = :_id')
														->param(':_id',$id)
														->execute();
		
		return $del;
	}
	
	public function del_dishType($id)
	{
		$del = DB::query(Database::DELETE, 'DELETE FROM dish_type where id = :_id')
											->param(':_id',$id)
											->execute();
		
		return $del;
	}
	
	public function del_menuType($id)
	{
		$del = DB::query(Database::DELETE, 'DELETE FROM dish_category where id = :_id')
											->param(':_id',$id)
											->execute();
		
		return $del;
	}
}