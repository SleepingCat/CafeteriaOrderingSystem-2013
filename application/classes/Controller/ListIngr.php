<?php defined('SYSPATH') or die('No direct script access.');

class Controller_ListIngr extends Controller_Front
{
	public function action_index()
	{
		$listIngr = DB::query(Database::SELECT, 'SELECT * from products')
		->execute()
		->as_array();
		$_SESSION['ingr_list_of_ingr'] = $listIngr;
		
		$this -> title = 'Список ингредиентов';
		//Передаем полученные данные во вьюху
		$this->content = View::factory('ingridients/listIngr')
		->set('list', $_SESSION['ingr_list_of_ingr']);
		
		if (@$_POST['newIngr'])
		{
			$this->title = "Добавить ингредиент";
			
			$this->content = View::factory('ingridients/addIngr')
			->set("text",$text="");
		}
		elseif (@$_POST['delete'])
		{
			if(isset($_POST['check']))
			{
				$checked = $_POST['check'];
				$list_of_ingr = $_SESSION['ingr_list_of_ingr'];
				foreach ($checked as $key => $value) 
				{
					$ingridient = new Model_DelTypeMenuDishIngr();
					$delIngr = $ingridient -> del_ingr($list_of_ingr[$key]['product_id']);
					$this->redirect('ListIngr');
				}
			}
			
			if(empty($_POST['check']))
			{
				$this->content = View::factory('createDishType/emptyPage');
			}
		}
		
		if (@$_POST['back'])
		{
			$this->redirect('ListIngr');
		}
		
	}
	
	public function action_AddData()
	{
		if (!empty($_POST['Name']) and !empty($_POST['Balance']) and ($_POST['Dimension']))
		{
			$Ingr = new Model_NewIngr();
			$newIngr = $Ingr -> add_new_ingr($_POST['Name'], $_POST['Balance'], $_POST['Dimension']);
			$text = "Ингредиент успешно добавлен!";
			$this->content = View::factory('ingridients/addIngr')
			->set("text",$text);
		}
		elseif (empty($_POST['Name']) or empty($_POST['Balance']) or ($_POST['Dimension']))
		{
			$text = "Введите данные!";
			$this->content = View::factory('ingridients/addIngr')
			->set("text",$text);
		}
		
		if (@$_POST['reverse'])
		{
			$this -> redirect('ListIngr');
		}
	}
}