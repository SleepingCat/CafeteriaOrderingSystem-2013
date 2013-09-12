<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Пример класса, работающего на основе ORM. 
 * @author Sergey S. Smirnov
 */
class Model_Ormexample extends ORM {
	
	public function getinfo() {
		return 'Data';
	}
	
}