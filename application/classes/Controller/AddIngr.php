<?php defined('SYSPATH') or die('No direct script access.');

class Controller_AddIngr extends Controller_Front
{
	public function action_index()
	{
		$this->title = "Добавить ингредиент";
		
		$this->content = View::factory('ingridients/addIngr')
		->set("text",$text="");
	}
	
	public function action_AddData()
	{
		if (!empty($_POST['Name']) and !empty($_POST['Balance']))
		{
			$Ingr = new Model_NewIngr();
			$newIngr = $Ingr -> add_new_ingr($_POST['Name'], $_POST['Balance']);
			$text = "Ингредиент успешно добавлен!";
			$this->content = View::factory('ingridients/addIngr')
			->set("text",$text);
		}
		elseif (empty($_POST['Name']) or empty($_POST['Balance']))
		{
			$text = "Введите данные!";
			$this->content = View::factory('ingridients/addIngr')
			->set("text",$text);
		}
	}
}