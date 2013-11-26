<?php defined('SYSPATH') or die('No direct script access.');

class Controller_ListDishType extends Controller_Front
{
	public function action_index()
	{
		$listDishType = DB::query(Database::SELECT, 'SELECT * from dish_type')
		->execute()
		->as_array();
		
		//Передаем полученные данные во вьюху
		$this->content = View::factory('createDishType/listType')
		->set('list', $listDishType);
		
		if (@$_POST['newType'])
		{
			$this->title = "Добавить новый тип блюда";
			
			$this->content = View::factory('createDishType/addNewDishType')
			->set("text",$text="");
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