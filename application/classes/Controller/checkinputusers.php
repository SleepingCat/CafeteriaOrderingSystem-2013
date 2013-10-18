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
		
	//	if($auth->logged_in('manager') == 0)  $this->redirect('netprav');

		if( ! Auth::instance()->logged_in('manager'))
		{
			throw new HTTP_Exception_403('Вы не имеете право редактировать запись');
		}		
		
		
		//if($auth->logged_in('login') == 0)  $this->redirect('netprav');
		
		return parent::before();		
	}
}