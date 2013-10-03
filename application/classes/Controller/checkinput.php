<?php defined('SYSPATH') or die('No direct script access.');

abstract class Controller_Checkinput extends Controller_Front {


public function before()
	
	{
	
	    $session = Session::instance();
		$session->set('auth_redirect', $_SERVER['REQUEST_URI']);
		
		/*
		Проверяем если пользователь зашел в систему как админ,то контроллер admin ему доступен(т.е админ-панель)
		*/
		$auth = Auth::instance();
		if($auth->logged_in() == 0)  $this->redirect('auth');
	    
		if($auth->logged_in('admin') == 0)  $this->redirect('netprav');
		return parent::before();
			// load configs
		foreach ($this->config_groups as $group)
		{
			$this->config[$group] = Kohana::$config->load($group)->as_array();
		}

		// bind this value as global for all templates
		View::set_global('config', $this->config);

		// bind as global value session message if exists
		View::set_global('message', Session::instance()->get_once('message'));
		View::set_global('message_type', Session::instance()->get_once('message_type'));

		// bind as global value session errors if exists
		View::set_global('errors', Session::instance()->get_once('errors', array()));
		
    }
	
	 

	
} // End Admin Layout Secure Controller
