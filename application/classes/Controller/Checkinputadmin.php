<?php defined('SYSPATH') or die('No direct script access.');
/**
 * 
 * @author Babur
 * Контролл для проверки прав доступ к админ панели
 */
abstract class Controller_Checkinputadmin extends Controller_Front {

public function before()	
	{	/**
			Создаем сессии на случай если пользователь выберит нужный контрол, там вызываем эту сессию в контролле auth
		*/
	    $session = Session::instance();
		$session->set('auth_redirect', $_SERVER['REQUEST_URI']);
		$auth = Auth::instance();
		/**
		  Проверяем если пользователь не авторизован, то редиректим его на контроллер авторизвции
		 */		
		if($auth->logged_in() == 0)  $this->redirect('auth');		
		/**
		 Проверяем если пользователь зашел в систему как админ,то контроллер admin ему доступен(т.е админ-панель)
		*/
		if($auth->logged_in('admin') == 0)
		$this->redirect('netprav');	
		
		return parent::before();		
		
	}
	
} // End Admin Layout Secure Controller
