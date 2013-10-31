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
	
	public function action_delete($dish_id)
	{
		$model_reestr = new Model_Reestr();
		$model_reestr->delete_dish($dish_id);
						
	}
	
}