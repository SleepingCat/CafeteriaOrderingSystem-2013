<?php defined('SYSPATH') or die('No direct script access.');

class Controller_createMenu extends Controller_Front
 {

	public function action_index()
	{
		$this->content = View::factory('createMenu/crtmSetDate')->set('title', "Создать меню");
	}
	
	/**
	 * Метод вывод страницу с ошибкой.
	 * @param $errorText - текст ошибки.
	 */
	public function showErrorPage($errorText)
	{		
		$this->content = View::factory('createMenu/errorPage')
		                 ->set('errorText', $errorText)
		                 ->set('title', "ОШИБКА!");
	}

	public function action_getStandartMenu()
	{
		$dishModel = new Model_MenuDBOperation();
		if (isset($_POST))
		{
			if (Valid::date($_POST['Date']))
			{
				//проверяем существование меню на указанную дату
				if($dishModel->checkMenu($_POST['Date'])) //если меню не существует
				{
					$this->content = View::factory('createMenu/crtmMenu')
					                 ->set('allDish', $dishModel->getDish());
				}
				else //если такое меню уже есть
				{
					$this->showErrorPage('Меню на указанную дату уже существует');
				}
			}
		}
	}

 }