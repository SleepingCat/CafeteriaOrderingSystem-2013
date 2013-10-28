<?php defined('SYSPATH') or die('No direct script access.');

class Model_MenuDBOperation
{
	/**
	 * Метод определяет наличие меню в базе, на указанную дату. 
	 * @param  $date - Дата на которую проверяется меню
	 * @return boolean
	 */
	public function checkMenu($date)
	{
		$count = DB::query(Database::SELECT, 'Select count(*) as menuCount from menus where menu_date = :menuDate')
		         ->param(':menuDate', $date)
		         ->execute()
		         ->get('menuCount', 0);
		if($count > 0)
		  return (FALSE);
		else
		  return (TRUE);	
	}
	
	/**
	 * Метод возвращает список блюд для построения меню
	 * @return Ambigous <multitype:, multitype:unknown NULL >
	 */
	public function getDish()
	{
		$dishes = array();	
		$query = 'select D.dish_name as dishName, 
				         DT.name as dishTypeName, 
				         DC.name as dishCategName, 
				         case when P.product_name is null then "-" else P.product_name end as productName
                  from dishes D
                  join dish_type DT on DT.id = D.dish_type_id
                  join dish_category DC on DC.id = D.dish_category_id
                  left join ingredients I on I.dish_Id = D.dish_id
                  left join products P on P.product_id = I.product_Id
                  order by 2 desc, DC.priority';	
		$dishes = DB::query(Database::SELECT, $query)
                  ->execute()
                  ->as_array(); 
		return($dishes);                            
	}
	
    /**
     * Метод возвращает список категорий блюд
     * @return Ambigous <multitype:, multitype:unknown NULL >
     */
	public function getCategoryOfDishs()
	{
		$dishesCategories = array();
		$query = 'select id, 
				         name, 
				         order
				  from dish_category';
		$dishesCategories = DB::query(Database::SELECT, $query)
		                    ->execute()
		                    ->as_array();
		return($dishesCategories);
	}
	
	/**
	 * Метод возвращает типы блюд
	 * @return multitype:
	 */
	public function getTypesOfDishes()
	{
		$typesOfDish = array();
		$query = 'select id,
				         name
				  from dish_type';
		$dishesCategories = DB::query(Database::SELECT, $query)
		                    ->execute()
		                    ->as_array();
		return($typesOfDish);
	}
}