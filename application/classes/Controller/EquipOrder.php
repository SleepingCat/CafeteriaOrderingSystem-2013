<?php defined('SYSPATH') or die('No direct script access.');

class Controller_EquipOrder extends Controller_Front
{
	public function action_index()
	{
		$per = (new Model_EquipOrder())->get_period();
		$ord = (new Model_EquipOrder())->get_orders();
	}
	
}