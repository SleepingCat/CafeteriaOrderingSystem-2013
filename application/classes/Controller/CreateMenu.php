<?php defined('SYSPATH') or die('No direct script access.');

class Controller_CreateMenu extends Controller_Checkinputusers
 {


	public function action_index()
	{
	   $this->action_showMenuList(date("Y-m-d"));
	}
	
	
	/**
	 * Метод отображает перечень доступных меню на дату.
	 */
	public function action_showMenuList($date)
	{
		$menuModel = new Model_MenuDBOperation();
		// сохраняем дату на которую создаём/редактируем меню.
		$_SESSION["crtm_menu_date"] = $date; 
		// сохраняем список меню
		$_SESSION["crtm_menu_list"] = $menuModel->getMenuList($date);
		$this->content = View::factory('createEditMenu/crtmShowMenuList')
		                 ->set("title", "Создать или изменить меню")
		                 ->set("setOfMenu", $_SESSION["crtm_menu_list"])
		                 ->set("menu_date", $_SESSION["crtm_menu_date"]);
	}
	
	/**
	 * Метод вывод страницу с ошибкой.
	 * @param $errorText - текст ошибки.
	 */
	public function action_showMessageToUser($message)
	{		
		$this->content = View::factory('createMenu/errorPage')
		                 ->set('errorText', $message);
	}
    
	
    
	public function action_RunAction()
	{
		$menuModel = new Model_MenuDBOperation();
		
		if(@$_POST["butSave"])//если необходимо сохранить
		{
			$dataToUpdate = array();
			$newMenu = $_SESSION["crtm_new_menu"];
			$menu_id = $_SESSION["crtm_menu_id"];
			if (isset($_SESSION["crtm_need_insert_dish"]))
			  $menuModel->saveMenuDish($_SESSION["crtm_menu_id"], $_SESSION["crtm_need_insert_dish"]); //добавляем новые блюда
			foreach ($_POST["price"] as $key => $value) 
			{
				$dataToUpdate[$key]["id"] = $newMenu[$key]["dish_id"];
				$dataToUpdate[$key]["price"] = $value;
				$dataToUpdate[$key]["menu_id"] = $menu_id;
			}
			$menuModel->updatePrice($dataToUpdate);
			$this->action_showMenuList(date("Y-m-d"));
			
		}	
		else if(@$_POST["butAddMenu"])//если необходимо добавить меню.
		{
		   $_SESSION["crtm_menu_date"] = $_POST["menuDate"]; 
		   $menu_id = $menuModel->checkMenu($_SESSION["crtm_menu_date"]); //Проверяем есть ли меню на указанную дату
		   if($menu_id > 0) // если есть
		   {
		   	  // TODO сругнуться и предложить редактировать меню. 
		   	  // А пока что просто буду открывать на редактирование
              $_SESSION["crtm_new_menu"] =  $menuModel->getAllDish(0,0,0,$menu_id);
		   	  $_SESSION["crtm_menu_id"] = $menu_id;// сохраним для дальнейшей работы с меню
		   	  $this->content = View::factory("createEditMenu/crtmShowMenu")
		   	                   ->set("allDish",  $_SESSION["crtm_new_menu"])
		   	                   ->set("menuDate", $_SESSION["crtm_menu_date"])
		   	                   ->set("forEdit", TRUE);
		   	                   
		   }
		   else // меню на указанную дату в базе нет
		   { 
		   	  //создаём меню и предлагаем наполнить его блюдами
		   	  $menu_id = $menuModel->saveMenu( $_SESSION["crtm_menu_date"]);
		   	  $_SESSION["crtm_new_menu"] =  $menuModel->getAllDish(1, 0, 0, $menu_id);
		   	  if( $menu_id > 0)
		   	  {
		   	  	$_SESSION["crtm_menu_id"] = $menu_id;// сохраним для дальнейшей работы с меню
		   	  	$this->content = View::factory("createEditMenu/crtmShowMenu")
		   	                     ->set("allDish", $_SESSION["crtm_new_menu"])
		   	                     ->set("menuDate", $_SESSION["crtm_menu_date"])
		   	                     ->set("forEdit", TRUE);
		   	  }
		   	  
		   }
		}
		else if(@$_POST["butAddDish"]) 
		{
			$_SESSION["crtm_dish_to_select"] =  $menuModel->getAllDish(2, 0, 0, 0);
			$this->content = View::factory("createEditMenu/crtmShowMenu")
			                 ->set("allDish", $_SESSION["crtm_dish_to_select"])
			                 ->set("menuDate", $_SESSION["crtm_menu_date"])
			                 ->set("typeOfDish",  $menuModel->getTypesOfDishes())
			                 ->set("categoryOfDish", $menuModel->getCategoryOfDishs())
			                 ->set("forEdit", FALSE);
		}
		else if(@$_POST["addInMenu"])
		{
			// получаем массивы для работы
			$newMenu = array(); //хранит текущее меню
			$needInsertDish = array(); // массив хранит блюда которые необходимо заинсёртить при сохранении меню.
			$checkedElements = $_POST["checked_elements"]; // хранит выбранные элементы
			$dishToSelect = $_SESSION["crtm_dish_to_select"]; // исходный массив с блюдами для выбора
			if (isset($_SESSION["crtm_new_menu"])) // если в сессии есть текущее меню то берём его
			{
				$newMenu = $_SESSION["crtm_new_menu"]; 
			}
						
			foreach ($checkedElements as $key => $value) //добавляем выбранные блюда в меню и в 
			                                             //сессию, потом возьмём их для инсёрта в базу
			{
				$result = TRUE;
				foreach ($newMenu as $keyM => $valueM)
			    {
			    	if(in_array($dishToSelect[$key]["dish_id"], $valueM))
			    		$result = FALSE;
				}
				if ($result)
				{
				    $dishToSelect[$key]["price"] = 0;
					array_push($newMenu, $dishToSelect[$key]);
					array_push($needInsertDish, $dishToSelect[$key]);
				}
			}
			$_SESSION["crtm_need_insert_dish"] = $needInsertDish; //сохраняем, для инсёрта
		
			function cmp($a, $b) // для сортировки массива по двум полям
			{
				$orderBy=array('dish_type'=>'desc', 'priority'=>'asc');
				$result= 0;
				foreach($orderBy as $key_1 => $value_1)
			    {
					if($a[$key_1] == $b[$key_1]) continue;
					$result= ($a[$key_1] < $b[$key_1])? -1 : 1;
					if($value_1=='desc') $result= -$result;
					break;
				}
				return $result;
			}
			
			
			usort($newMenu, 'cmp'); // сортируем массив с блюдами
			
			$_SESSION["crtm_new_menu"] = $newMenu;  // сохраняем текущее меню в сессию для вывода на экран
			
			$this->content = View::factory("createEditMenu/crtmShowMenu") //отрисовываем обновлённое меню
			                 ->set("allDish", $_SESSION["crtm_new_menu"])
			                 ->set("menuDate", $_SESSION["crtm_menu_date"])
			                 ->set("forEdit", TRUE);
		}
		else if(@$_POST["butUpdate"])
		{
			$this->action_showMenuList($_POST["menuDate"]);
		}
		else if(@$_POST["butApply"])
		{
			$_SESSION["crtm_dish_to_select"] = $menuModel->getAllDish(2, $_POST["typeOfDish"], $_POST["categoryOfDish"], 0);
			$this->content = View::factory("createEditMenu/crtmShowMenu") //отрисовываем обновлённое меню
			                 ->set("allDish", $_SESSION["crtm_dish_to_select"])
			                 ->set("menuDate", $_SESSION["crtm_menu_date"])
			                 ->set("typeOfDish",  $menuModel->getTypesOfDishes())
			                 ->set("categoryOfDish", $menuModel->getCategoryOfDishs())
			                 ->set("forEdit", FALSE);
		}
		else if(@$_POST["edit"])
		{
			$menuList = $_SESSION["crtm_menu_list"];
			foreach ($_POST["edit"] as $key => $value) 
			{
				$menu_id = $menuList[$key]["menu_id"];
			}
			unset($_SESSION["crtm_need_insert_dish"]);
			$_SESSION["crtm_new_menu"] =  $menuModel->getAllDish(0,0,0,$menu_id);
			$_SESSION["crtm_menu_id"] = $menu_id;// сохраним для дальнейшей работы с меню
			$this->content = View::factory("createEditMenu/crtmShowMenu")
			                 ->set("allDish",  $_SESSION["crtm_new_menu"])
			                 ->set("menuDate", $_SESSION["crtm_menu_date"])
			                  ->set("forEdit", TRUE);
		}
		else if(@$_POST["delete"])
		{
			$menuList = $_SESSION["crtm_menu_list"];
			foreach ($_POST["delete"] as $key => $value)
			{
				$menu_id = $menuList[$key]["menu_id"];
			}
			$menuModel->deleteMenu($menu_id);
			$this->action_showMenuList($_POST["menuDate"]);
		}
		 	
	}

 }