<?php defined('SYSPATH') or die('No direct script access.');
/**
 * 
 * @author Babur
 *	Контролл для проверки парв доступа пол-й
 */
abstract class Controller_Checkinputusers extends Controller_Front {
	
public function before()	
	{	/**
		Создаем сессии на случай если пользователь выберит нужный контрол,а там вызываем эту сессию в контролле auth
		*/
	    $session = Session::instance();
		$session->set('auth_redirect', $_SERVER['REQUEST_URI']);		
		/**
		 Проверяем если пользователь не авторизован, то редиректим его на контроллер авторизвции
		 */
		$auth = Auth::instance();
		if($auth->logged_in() == 0)  $this->redirect('auth');		
		return parent::before();		
	}
}