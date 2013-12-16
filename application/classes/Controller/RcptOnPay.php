<?php defined('SYSPATH') or die('No direct script access.');

class Controller_RcptOnPay extends Controller_Checkinputusers
 {


	public function action_index()
	{
		$this->content = View::factory('rcptOnPay');
	}

	public function action_GenerateCheck()
	{
		$model = new Model_MenuDBOperation();
	    $reportData = $model->
	}
 }