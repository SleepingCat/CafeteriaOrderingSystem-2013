<?php defined('SYSPATH') or die('No direct script access.');

class Controller_ListDishType extends Controller_Front
{
	public function action_index()
	{
		$listDishType = DB::query(Database::SELECT, 'SELECT * from dish_type')
		->execute()
		->as_array();
		$_SESSION['list_of_dishType'] = $listDishType;
		
		$this -> title = 'Список типов меню';
		//Передаем полученные данные во вьюху
		$this->content = View::factory('createDishType/listDishType')
		->set('list', $_SESSION['list_of_dishType']);
		
		if (@$_POST['newType'])
		{
			$this->title = "Добавить новый тип блюда";
			
			$this->content = View::factory('createDishType/addNewDishType')
			->set("text",$text="");
		}
		elseif (@$_POST['delete'])
		{
			if(isset($_POST['check']))
			{
				$checked = $_POST['check'];
				$list_of_dish = $_SESSION['list_of_dishType'];
				foreach ($checked as $key => $value)
				{
					$dish = new Model_DelTypeMenuDishIngr();
					$delDishType = $dish -> del_dishType($list_of_dish[$key]['id']);
					$this->redirect('ListDishType');
				}
			}
			if(empty($_POST['check']))
			{
				$this->content = View::factory('createDishType/emptyPage');
			}
		}
		
		if (@$_POST['back'])
		{
			$this->redirect('ListDishType');
		}
		
	}
	
	public function action_AddData()
	{
		if (!empty($_POST['Name']))
		{
			$Type = new Model_NewDishType();
			$newType = $Type -> add_new_dishType($_POST['Name']);
			$text = "Новый тип успешно добавлен!";
			$this->content = View::factory('createDishType/addNewDishType')
			->set("text",$text);
		}
		elseif (empty($_POST['Name']))
		{
			$text = "Введите данные!";
			$this->content = View::factory('createDishType/addNewDishType')
			->set("text",$text);
		}
		
		if (@$_POST['reverse'])
		{
			$this -> redirect('ListDishType');
		}
	}
}