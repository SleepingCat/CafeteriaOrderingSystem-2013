<?php defined('SYSPATH') or die('No direct script access.');

class Model_NewIngr
{
	public function add_new_ingr($ingr, $balance)
	{
		$ingr = DB::query(Database::INSERT, 'insert into products set product_name = :ingr, balance = :bal')
		->param(':ingr', $ingr)
		->param(':bal', $balance)
		->execute();
		
		return $ingr;
	}
}