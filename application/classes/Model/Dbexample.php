<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Пример класса, работающего с базой данных напрямую. 
 * @author Sergey S. Smirnov
 */
class Model_Ormexample extends Database {
	
	public function getinfo() {
		return 'Data';
	}
	
}