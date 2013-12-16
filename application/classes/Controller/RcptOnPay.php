<?php defined('SYSPATH') or die('No direct script access.');

class Controller_RcptOnPay extends Controller_Checkinputusers
 {


	public function action_index()
	{
		$this->content = View::factory("rcptOnPay")
		                 ->set("message", "");
	}

	/**
	 * Запуск построения отчёта/счёта
	 */
	public function action_GenerateCheck()
	{
		$beginDate = ($_POST["beginDate"]);
		$endDate = ($_POST["endDate"]);
		
		$tmpDate1 = strtotime($_POST["beginDate"]) + 60 * 60 * 24 * 7;
		if($tmpDate1 < strtotime($_POST["endDate"]))
			$this->content = View::factory("rcptOnPay")
			                 ->set("message", "Введённый период болше недели. Сократите период.");
		else 
		{
			$repModel = new Model_Report();
		    $repModel->ExportWordSumm($beginDate, $endDate);
		}
	}
 }