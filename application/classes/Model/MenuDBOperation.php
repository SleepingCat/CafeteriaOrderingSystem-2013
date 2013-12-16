<?php defined('SYSPATH') or die('No direct script access.');

class Model_MenuDBOperation
{
	/**
	 * Метод возвращает все имеющиеся меню на определённую дату 
	 * @param DateTime $date - дата на которую смотрится список меню.
	 * @return Ambigous <multitype:, multitype:unknown NULL >
	 */
	public function getMenuList($date)
	{
		$menuList = array();
		$menuList = DB::query(Database::SELECT, "select menu_id, menu_date 
				                                 from menus
				                                 where menu_date >= :menuDate")
				    ->param(":menuDate", $date)
				    ->execute()
				    ->as_array();
		return($menuList);                             
	}
	
	
	/**
	 * Метод определяет наличие меню в базе, на указанную дату. 
	 * @param  $date - Дата на которую проверяется меню
	 */
	public function checkMenu($date)
	{
		$menu_id = DB::query(Database::SELECT, 'Select menu_id from menus where menu_date = :menuDate')
		         ->param(':menuDate', $date)
		         ->execute()
		         ->get('menu_id', 0);
		return($menu_id);	
	}

	/**
	 * Создаёт в базе запись о меню на указанную дату
	 * @param DateTime $date - дата на которую создаётся меню
	 * @return boolean
	 */
	public function saveMenu($date)
	{
		$menuID = 0;
		// добавляем меню в базу
		$query = "insert into menus (menu_date) values (\"".$date."\")";
		$qResult =  DB::query(Database::INSERT, $query)
		            ->execute();
		if($qResult[1] == 1)
		{
			$menuID = DB::query(Database::SELECT, "select menu_id 
					                               from menus 
					                               where menu_date = :date")
					  ->param(":date", $date)
					  ->execute()
					  ->get("menu_id");
			return $menuID;
		}
		else 
			return 0;
			
	}

	public function saveMenuDish($menuID, $dishes)
	{
		for ($i = 0; $i < count($dishes); $i++) 
		{
			$qResult =  DB::query(Database::INSERT, "insert into menu_records (menu_id, dish_id, price) values (:menuID, :dishID, :price)")
			            ->param(":menuID", $menuID)
			            ->param(":dishID", $dishes[$i]["dish_id"])
			            ->param(":price", $dishes[$i]["price"])
			            ->execute();
		}
	}
	
    /**
     * Метод возвращает список категорий блюд
     * @return Ambigous <multitype:, multitype:unknown NULL >
     */
	public function getCategoryOfDishs()
	{
		$dishesCategories = array();
		$query = 'select id, 
				         name
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
		$typesOfDish = DB::query(Database::SELECT, $query)
		                    ->execute()
		                    ->as_array();
		return($typesOfDish);
	}
	
	
    /**
     * Метод для получения блюд 
     * @param integer $param - указывает на стандартность(если 1 то отбираются только стандартные блюда)
     * @param integer $type - возвращает блюда указанного типа
     * @param integer $category - возвращает блюда указанной категории
     * @param integer $menuID - возвращает блюда только из указанного меню.
     * @return Ambigous <multitype:, Ambigous, multitype:unknown NULL >
     */
	public function getAllDish($param, $type = 0, $category = 0, $menuID = 0)
	{ 
		$filter = "";// фильтр для установки условий
		
		if(($param <> 0) or ($type > 0) or ($category > 0))
			$filter = "where";
		
		if ($type > 0)//ограничение по типу блюда
		{
			if($filter <> "where")
				$filter = $filter." and DT.id = ".$type;
			else 
				$filter = $filter." DT.id = ".$type;
		}
			
		if($category > 0)//ограничение по категории
		{
			if($filter <> "where")
				$filter =  $filter." and DC.id = ".$category;
			else 
				$filter =  $filter." DC.id = ".$category;
		}
			
		// дополнительные условия
		switch($param):
			case 1:
				if($filter <> "where")
					$filter =  $filter."and D.is_standart <> 0 
						   order by 4 desc, DC.priority asc";
				else 
					$filter =  $filter." D.is_standart <> 0
						   order by 4 desc, DC.priority asc";
				break;
			case 2:
				if($filter <> "where")
				    $filter =  $filter." and (D.is_standart = 0 or D.is_standart is null)
						               order by 4 desc, DC.priority asc";
				else 
					$filter =  $filter." (D.is_standart = 0 or D.is_standart is null)
						               order by 4 desc, DC.priority asc";
				break;
			default:
				    $filter =  $filter." order by 4 desc, DC.priority asc";		

		endswitch;
		
		$allDish = array();
		
		if($menuID > 0) // Для оторбажения списка блюд в созданном меню, релактирование
			$query= "select D.dish_id, 
                            D.dish_name,
					        MR.price, 
                            D.is_standart, 
                            DT.name as dish_type, 
                            DC.name as dish_categ,
					        DC.priority
                      from menus M
					  join menu_records MR on MR.menu_id = M.menu_id and
					                          MR.menu_id = ".$menuID." 
					  join dishes D on D.dish_id = MR.dish_id 
                      join dish_type DT on DT.id = D.dish_type_id
                      join dish_category DC on DC.id = D.dish_category_id ".$filter;
		else //Для отображения списка блюд для создания меню
		    $query = "select D.dish_id, 
                             D.dish_name, 
                             D.is_standart, 
                             DT.name as dish_type, 
                             DC.name as dish_categ,
		    		         DC.priority
		    	  from dishes D
                  join dish_type DT on DT.id = D.dish_type_id
                  join dish_category DC on DC.id = D.dish_category_id ".$filter;
        $allDish = DB::query(Database::SELECT, $query)
		           ->execute()
		           ->as_array();
		for ($i = 0; $i < count($allDish); $i++)
		{
		  $allDish[$i]["ingredients"] = $this->getIngredients( $allDish[$i]['dish_id']);
		}
		return($allDish);
	}
	
	
	/**
	 * Метод возвращвет имена ингредиентов входящих в блюдо
	 * @param $dishID - ИД блюда
	 * @return Ambigous <multitype:, multitype:unknown NULL >
	 */
    public function getIngredients($dishID)
    {
    	$ingredients = array();
    	$query = 'select product_name
    			  from products P
    			  join ingredients I on I.product_id = P.product_id and
    			                        I.dish_id = '.$dishID;
    	$ingredients = DB::query(Database::SELECT, $query)
    	               ->execute()
    	               ->as_array();
    	return($ingredients);
    }
    
    /**
     * Метод добавляет в базу меню
     * @param Date $date - дата на которую добавляется меню.
     * @param Array $menu - список блюд, вхлдящих в меню.
     * @return number - возвращает 1 если добавление прошло удачно, 0 в ином случае.
     */
    public function saveMenuToDB($date, $menu)
    {
    	// добавляем меню в базу
    	$query = 'insert into menus (menu_date) values (\''.$date.'\')';
    	$qResult =  DB::query(Database::INSERT, $query)
    	                ->execute();
    	if($qResult[1] == 1) //если меню добавилось то добавляем и его строки
    	{
	    	$query = '';
	    	//получаем id только что добавленного меню
	    	$query = 'select menu_id from menus where menu_date = \''.$date.'\'';
	    	$menu_id =  DB::query(Database::SELECT, $query)
	    	                ->execute()
	    	                ->get('menu_id');
	    	//добавляем строки
	    	foreach ($menu as $key => $value) 
	    	{
	    		DB::query(Database::INSERT, 'insert into menu_records (dish_id, price, portion_type_id, menu_id) 
	    				                      value(:dish_id, :price, :portion, :menu_id)')
	    				  ->param(":dish_id", $value["dish_id"])
	    				  ->param(":price", $value["price"])
	    				  ->param(":portion", $value["dish_portion"])
	    				  ->param(":menu_id", $menu_id)
	    				  ->execute();                     
	    	}
	    	return(1);
    	}
    	else //если не добавилось, то сообщаем пользователю об ошибке
    	{
    		return(0);
    	}
    }

    public function deleteMenu($menuID)
    {
        DB::query(Database::DELETE, "delete from menus  
        		                     where menus.menu_id =:menuID and 
        		                           not exists(select order_id 
        		                                      from orders_records
        		                                      where menu_record_menu_id =:menuID)")
    	          ->param(":menuID", $menuID)
    	          ->execute();
    	DB::query(Database::DELETE, "delete from menu_records
                                     where menu_records.menu_id =:menuID and 
        		                           not exists(select order_id 
        		                                      from orders_records
        		                                      where menu_record_menu_id =:menuID)")
    	          ->param(":menuID", $menuID)
    	          ->execute();
    }
    
    
    public function updatePrice($updates)
    {
    	$operationResult = ""; // результат выполнения обновления цен.
    	
    	foreach ($updates as $key => $value) 
    	{
    		//проверить нет ли заказов из этого меню на это блюдо
	    	$counter = 0;
	    	$counter = DB::query(Database::SELECT, "select count(*) as counter 
	    			                     from orders_records 
	    			                     where menu_record_menu_id = :menuID and 
	    			                           menu_record_dish_id = :dishID")
	    		->param(":menuID", $value["menu_id"])
	    		->param(":dishID", $value["id"])	  
	    		->execute()
	    		->get("counter");
	    	
    	    if($counter == 0)// если блюдо не заказывали, то обновляем ему цену
    	    {
    	    	DB::query(Database::UPDATE, "update  menu_records set price =:price
                                             where dish_id = :dishID and
        		                                   menu_id = :menuID")
    	    	        		                           ->param(":menuID", $value["menu_id"])
    	    	        		                           ->param(":dishID", $value["id"])
    	    	        		                           ->param(":price", $value["price"])
    	    	        		                           ->execute();
    	         $operationResult = "Цены изменены";
    	    }
    	    else //иначе ничего не делаем, добавляем в результат данные о текущем меню
    	    {
    	    	if($operationResult != "")
    	    	{
    	    		$operationResult += "Не удалось обновить цену, т.к. на блюдо ". $value["dish_name"]."есть заказ\n";
    	    	}
    	    }
    	}
    	
    	return($operationResult);
    }
    
    /**
     * Метод удаляет блюдо из меню
     * @param integer $menuID - ИД меню из которого удаляют блюдо
     * @param integer $dishID - ИД удаляемого блюда
     * @return строка с результатом
     */
    public function deleteDish($menuID, $dishID)
    {
    	$operationResult = "";
    	
    	//проверить нет ли заказов из этого меню на это блюдо
    	$counter = 0;
    	$counter = DB::query(Database::SELECT, "select count(*) as counter 
    			                     from orders_records 
    			                     where menu_record_menu_id = :menuID and 
    			                           menu_record_dish_id = :dishID")
    		->param(":menuID", $menuID)
    		->param(":dishID", $dishID)	  
    		->execute()
    		->get("counter");
        if($counter == 0)//если нет, то удалить и создать строку "Удалено успешно!"
        {
        	DB::query(Database::DELETE, "delete 
        			                     from orders_records  
        			                     where menu_record_menu_id = :menuID and 
    			                               menu_record_dish_id = :dishID")
    			->execute();  
    			$operationResult = "Удалено успешно!";                             
        } 
        else //иначе не удалять создать строку "На блюдо есть заказ! Удаление не возможно"
        {
        	$operationResult = "На блюдо есть заказ! Удаление не возможно";
        }                        
    	
        return ($operationResult);
    	
    }
    
   public function GetCheckData($beginDate, $endDate)
   {
	   	$result = array();  
	   	$result = DB::query(Database::SELECT, "select user_id ,total_price,name,surname,patronymic,employee_number
	   	  		                       from orders join users on users.id=orders.user_id
	   	  		                       where order_date >= :beginDate and
	   	  		                             order_date <= :endDate")
	   	  		    ->param(":beginDate", $beginDate)
	   	  		    ->param(":endDate", $endDate)
	   	  		    ->execute()
	   	  		    ->as_array();        
	   	return($result);
   }
}