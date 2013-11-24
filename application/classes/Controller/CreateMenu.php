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
		$this->content = View::factory('createEditMenu/crtmShowMenuList')
		                 ->set("title", "Создать или изменить меню")
		                 ->set("setOfMenu", $menuModel->getMenuList($date));
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

	
    /**
     * Метод производит перенаправление на другой метод 
     * в зависимости от нажатой клавиши.
     */
	public function action_RunAction()
	{
		$menuModel = new Model_MenuDBOperation();
		
		if(@$_POST["butSave"])//если необходимо сохранить
			$this->saveMenu();
		else if(@$_POST["butAddMenu"])//если необходимо добавить меню.
		{
		   $_SESSION["crtm_menu_date"] = $_POST["menuDate"]; 
		   $menu_id = $menuModel->checkMenu($_SESSION["crtm_menu_date"]); //Проверяем есть ли меню на указанную дату
		   if($menu_id > 0) // если есть
		   {
		   	  // TODO сругнуться и предложить редактировать меню. 
		   	  // А пока что просто буду открывать на редактирование
		   	  
		   	  $_SESSION["crtm_menu_id"] = $menu_id;// сохраним для дальнейшей работы с меню
		   	  $this->content = View::factory("createEditMenu/crtmShowMenu")
		   	                   ->set("allDish", $menuModel->getAllDish(0,0,0,$menu_id))
		   	                   ->set("menuDate", $_SESSION["crtm_menu_date"])
		   	                   ->set("forEdit", TRUE);
		   	                   
		   }
		   else // меню на указанную дату в базе нет
		   { 
		   	  //создаём меню и предлагаем наполнить его блюдами
		   	  $menu_id = $menuModel->saveMenu( $_SESSION["crtm_menu_date"]);
		   	  if( $menu_id > 0)
		   	  {
		   	  	$_SESSION["crtm_menu_id"] = $menu_id;// сохраним для дальнейшей работы с меню
		   	  	$this->content = View::factory("createEditMenu/crtmShowMenu")
		   	                     ->set("allDish", $menuModel->getAllDish(1, 0, 0, $menu_id))
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
			$checkedElements = $_POST["checked_elements"];
		}
		else if(@$_POST["butUpdate"])
		{
			$this->action_showMenuList($_POST[menuDate]);
		}
		 	
	}

 }