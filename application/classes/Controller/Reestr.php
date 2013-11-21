<?php defined('SYSPATH') or die('No direct script access.');
//
//@autor = MrAnderson;
//
//
class Controller_Reestr extends Controller_Checkinputusers
{
	public function before()
	{
		Session::instance();
		parent::before();
	}
	
	public function action_index()
	{
		$model_reestr = new Model_Reestr();
		$reestr = $model_reestr->get_all_dishes();
		$this->content = View::factory('reestr/reestr')->bind('reestr', $reestr);
		
	}
	
	public function action_delete()
	{
		$dish_id = Request::current()->param('id');
		$model_reestr = new Model_Reestr();
		$model_reestr->delete_dish($dish_id);
		$this->redirect("http://".$_SERVER['HTTP_HOST']."/reestr");				
	}
	
	public function action_add()
	{
		$errcode = 0;
		
		$model_reestr = new Model_Reestr();
		$categories = $model_reestr->get_categories();
		$types = $model_reestr->get_types();
		$ingridients = $model_reestr->get_ingredient();
		
		$view = View::factory('reestr/dish_add_edit')->bind('errcode',$errcode)
													 ->bind('categories',$categories)
													 ->bind('ingredient',$ingridients)
													 ->bind('types',$types);

		$is_standart = null;
		
		if (isset($_POST["btn_dish_add"]))
		{
			if ($errcode==0) 
			{	
				if(isset ($_POST["standart"])) { $is_standart = 1; }
				
				if(isset($_POST["ingredients"]))
				{
					$model_reestr->add_dish($_POST['title'], $_POST['category'], $_POST['type'], $_POST['ingredients'], $is_standart);
				} 		
				else {
					$model_reestr->add_dish($_POST['title'], $_POST['category'], $_POST['type'], null, $is_standart);
				}
				
				$this->redirect("http://".$_SERVER['HTTP_HOST']."/reestr");
			}
			
		} 

		//$this->desu($_POST);
		
		$this->content=$view;
	}
	
	public function action_update()
	{	
		$dish_id = Request::current()->param('id');
		$errcode = 0;
		
		$model_reestr = new Model_Reestr();
		
		$dish = $model_reestr->get_dish($dish_id);
		
		$categories = $model_reestr->get_categories();
		$types = $model_reestr->get_types();
		$ingridients = $model_reestr->get_ingredient();
		
		$view = View::factory('reestr/dish_add_edit')->bind('errcode',$errcode)
		->bind('categories',$categories)
		->bind('ingredient',$ingridients)
		->bind('types',$types)
		->bind('dish',$dish);
		
		if (isset($_POST["btn_dish_add"]))
		{
			if ($errcode==0)
			{
				if(isset ($_POST["standart"])) { $is_standart = 1; } else {$is_standart = null; }
				if(isset ($_POST["available"])) { $is_available = 1; } else {$is_available = null;}
				if(isset($_POST["ingredients"]))
				{
					$model_reestr->update_dish($_POST['title'], $_POST['category'], $_POST['type'], $_POST['ingredients'], $is_standart,$is_available);
				}
				else {
					$model_reestr->update_dish($_POST['title'], $_POST['category'], $_POST['type'], null, $is_standart,$is_available);
				}
		
				$this->redirect("http://".$_SERVER['HTTP_HOST']."/reestr");
			}
		}
	
	//	$this->desu($dish);
		$this->content=$view;
	}
	
	
	
}