<?php defined('SYSPATH') or die('No direct script access.');

class Controller_CreateMenu extends Controller_Checkinputusers
 {
 	public function before()
 	{
		Session::instance();
		parent::before();
	}

	public function action_index()
	{
		$this->content = View::factory('createMenu/crtmSetDate')->set('title', "Создать меню");
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
	 * Метод получает список стандартных блюд и отображает их.
	 */
	public function action_getStandartMenu()
	{
		if (isset($_POST))
		{
			$date = $_POST['Date'];
			if (Valid::date($date))
			{
				$currentDate = new DateTime("now");
				$inputDate = new DateTime($date);
				if($inputDate < $currentDate)
					$this->action_showMessageToUser("Введённая дата меньше текущей.");
				else if(intval(abs(strtotime($date) - time()))/(3600*24) > 14)
					$this->action_showMessageToUser("Введённая дата превышает текущую более чем на 14 дней.");
				else
				{
					$dishModel = new Model_MenuDBOperation();
					//проверяем существование меню на указанную дату
					if($dishModel->checkMenu($date)) //если меню не существует
					{
						   
	                       $allDish = $dishModel->getAllDish(1);                      
	                       $_SESSION["crtm_newmenu"] = array();
	                       $_SESSION["crtm_dish_to_select"] = $allDish;
	                       $_SESSION["crtm_menu_date"] = $date;
	
	                       $this->content = View::factory('createMenu/showMenu')
	                                             ->set('allDish', $_SESSION["crtm_dish_to_select"]);
					}
					else //если такое меню уже есть
					{
						$this->action_showMessageToUser('Меню на указанную дату уже существует');
					}
				}
			}
			else 
			{
				$this->showMessageToUser('Введена не корректная дата');
			}
		}
	}
	
	/**
	 * Метод сохраняет меню в базу и проводит анализ результата записи.
	 */
	public function saveMenu()
	{
        $this->addDish();
		$dishModel = new Model_MenuDBOperation();
		$date = $_SESSION["crtm_menu_date"];
		$menu = $_SESSION['crtm_newmenu'];
		if($dishModel->saveMenuToDB($date, $menu))
		  $this->action_showMessageToUser('Меню успешно сохранено.');
		else 
		  $this->action_showMessageToUser("Не удалось создать меню. Ошибка при записи в базу данных.");	
		
	}

	/**
	 * Метод получает все типы и категории имеющиеся в системе, и отображает их
	 */
	public function setTypeAndCategory()
	{
		$dishModel = new Model_MenuDBOperation();
		$typeOfDish = $dishModel->getTypesOfDishes();
		$categoryOfDish = $dishModel->getCategoryOfDishs();
		$this->content = View::factory('createMenu/setTypeAndCateg')
		                 ->set("typeOfDish", $typeOfDish)
		                 ->set("categoryOfDish", $categoryOfDish);
	} 
	
	
    /**
     * Метод производит перенаправление на другой метод 
     * в зависимости от нажатой клавиши.
     */
	public function action_RunAction()
	{
		if(@$_POST['butSave'])//если необходимо сохранить
			$this->saveMenu();
		else if(@$_POST['butAddDish'])//если необходимо добавить блюдо.
		{
		   $this->addDish(); // перекачиваем выбранные блюда в новое меню.
           $this->setTypeAndCategory();// отображаем список типов и категорий
		}   
		else if(@$_POST['butSelect']) // если надо отобразить блюда указанного типа и категории
		{
			$category = 0;
			$type = 0;
			if(isset($_POST["category"]))
				$category = $_POST["category"];
			if(isset($_POST["type"]))
				$type = $_POST["type"];
			$dishModel = new Model_MenuDBOperation();
			$_SESSION["crtm_dish_to_select"] = $dishModel->getAllDish(0, $type, $category);
			$this->content = View::factory('createMenu/showMenu')
		                 ->set('allDish', $_SESSION["crtm_dish_to_select"]);
		}
		else if(@$_POST["butToSetDate"])
			$this->content = View::factory('createMenu/crtmSetDate')
		                           ->set('title', "Создать меню");
			
	}
	
	
	/**
	 * Метод производит добавление выбранных блюд в итоговое меню, 
	 * а также проверку на уникальность блюда в меню
	 */
	public function addDish()
	{
		//временный массив для передачи блюд.
		$tmpArray = array();
		//массив с номерами выбранных блюд.
		$checkedElements = array();
		//массив с текущим меню.
		$currentMenu = array();
		$currentMenu = $_SESSION["crtm_newmenu"];
		//массив с блюдами предоставлнными к выбору.
		$dishToSelect = array();
		//массив с ценами блюд
		$dishPrice = array();
		
		if(isset($_POST["checked_elements"])&& isset($_SESSION["crtm_dish_to_select"]))
		{
			$dishToSelect = $_SESSION["crtm_dish_to_select"];
			$checkedElements = $_POST["checked_elements"];
			$dishPrice = $_POST["price"];
			
			foreach ($checkedElements as $key => $value) //для каждого выбранного блюда
			{
				$result = false;
				foreach ($currentMenu as $key_1 => $value) //проверка на дублирование
				{
					if(in_array($dishToSelect[$key]["dish_id"], $value))
						$result = TRUE;
				}

				if (!$result)//проверяем что его ещё нет в меню
				{
				    if(array_key_exists($key, $dishPrice)) //устанавливаем цену, если она есть
					  {
					    $dishToSelect[$key]["price"] = $dishPrice[$key];
					  }
				  
				    array_push($currentMenu, $dishToSelect[$key]);//добавляем в меню
				}
			}
			$_SESSION["crtm_newmenu"] = $currentMenu;
		}
	}

 }