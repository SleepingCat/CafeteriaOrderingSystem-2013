<?php defined('SYSPATH') or die('No direct script access.');

class Controller_ListMenuType extends Controller_Front
{
	public function action_index()
	{
		$listMenuType = DB::query(Database::SELECT, 'SELECT * from dish_category')
		->execute()
		->as_array();
		
		//Передаем полученные данные во вьюху
		$this->content = View::factory('createDishType/listMenuType')
		->set('list', $listMenuType);
		
		if (@$_POST['newTypeMenu'])
		{
			$this->title = "Добавить новый тип блюда";
			
			$this->content = View::factory('createDishType/addNewMenuType')
			->set("text",$text="");
		}
		
	}
	
	public function action_AddData()
	{
		if (!empty($_POST['Name']) or !empty($_POST['Priority']))
		{
			$Type = new Model_NewMenuType();
			$newType = $Type -> add_new_menuType($_POST['Name'], $_POST['Priority']);
			$text = "Категория успешно добавлен!";
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