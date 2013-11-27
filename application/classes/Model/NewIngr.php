<?php defined('SYSPATH') or die('No direct script access.');

class Model_NewIngr
{
	public function add_new_ingr($ingr, $balance, $dim)
	{
		$ingr = DB::query(Database::INSERT, 'insert into products set product_name = :ingr, balance = :bal, dimension = :dimension')
		->param(':ingr', $ingr)
		->param(':bal', $balance)
		->param(':dimension', $dim)
		->execute();
		
		return $ingr;
	}
}