<?php defined('SYSPATH') or die('No direct script access.');

class Controller_ListMenuType extends Controller_Front
{
	public function action_index()
	{
		$listMenuType = DB::query(Database::SELECT, 'SELECT * from dish_category')
		->execute()
		->as_array();
		$_SESSION['list_of_menuCategory'] = $listMenuType;
		
		$this -> title = 'Список категорий меню';
		//Передаем полученные данные во вьюху
		$this->content = View::factory('createDishType/listMenuType')
		->set('list', $_SESSION['list_of_menuCategory']);
		
		if (@$_POST['newTypeMenu'])
		{
			$this->title = "Добавить новый тип блюда";
			
			$this->content = View::factory('createDishType/addNewMenuType')
			->set("text",$text="");
		}
		
		elseif (@$_POST['delete'])
		{
			if(isset($_POST['check']))
			{
				$checked = $_POST['check'];
				$list_of_menu = $_SESSION['list_of_menuCategory'];
				foreach ($checked as $key => $value)
				{
					$menu = new Model_DelTypeMenuDishIngr();
					$delMenuCategory = $menu -> del_menuType($list_of_menu[$key]['id']);
					$this->redirect('ListMenuType');
				}
			}
			if(empty($_POST['check']))
			{
				$this->content = View::factory('createDishType/emptyPage');
			}
		}
		
		if (@$_POST['back'])
		{
			$this->redirect('ListMenuType');
		}
	}
	
	public function action_AddData()
	{
		if (!empty($_POST['Name']) or !empty($_POST['Priority']))
		{
			$Type = new Model_NewMenuType();
			$newType = $Type -> add_new_menuType($_POST['Name'], $_POST['Priority']);
			$text = "Категория успешно добавлена!";
			$this->content = View::factory('createDishType/addNewMenuType')
			->set("text",$text);
		}
		elseif (empty($_POST['Name']) or !empty($_POST['Priority']))
		{
			$text = "Введите данные!";
			$this->content = View::factory('createDishType/addNewMenuType')
			->set("text",$text);
		}
		
		if (@$_POST['reverse'])
		{
			$this -> redirect('ListMenuType');
		}
	}
}