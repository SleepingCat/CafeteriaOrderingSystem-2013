<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Главный контрол web-сайта, представляющий основной шаблон страницы.
 * @author Sergey S. Smirnov
 * @see Kohana_Controller_Template
 */
class Controller_Front extends Kohana_Controller_Template {
	
	/**
	 * Относительный путь к шаблону web-страницы.
	 * @var string
	 */
	public $template = '';
	/**
	 * Содержимое текущей web-страницы.
	 * @var string
	 */
	public $content = '';
	/**
	 * Пути к подключаемым JavaScript'ам.
	 * @var Array
	 */
	public $scripts = array();
	/**
	 * Пути к подключаемым таблицам стилей CSS.
	 * @var Array
	 */
	public $styles = array();
	/**
	 * Заголовок текущей страницы.
	 * @var string
	 */
	public $title = NULL;
	/**
	 * Полная информация о текущем пользователе.
	 * @var object
	 */
	public $user = NULL;
	/**
	 * Экземпляр безпасности текущего пользователя. 
	 * @var object
	 */
	public $a2 = NULL;
	/**
	 * Привилегии текущего пользователя.
	 * @var object
	 */
	public $privilege = NULL;
	/**
	 * Информация об авторизации текущего пользователя.
	 * @var object
	 */
	public $auth = NULL;	
	/**
	 * Выполняется до вызова загрузки основного контрола (шаблона) web-сайта.
	 * @see Kohana_Controller_Template::before()
	 */
	public function before() {
		// Определяем файл базового шаблона
		$this->template = 'templates' . DIRECTORY_SEPARATOR . 'default';
		// Вызываем родительский метод
		parent::before();
		// Получаем информацию о текущем пользователе
		if(Auth::instance()->logged_in())
		{
     		$user = Auth::instance()->get_user()->as_array();
			$this->user = 'Здорово,'.' '.$user['username'];
		}		
		else			
		{		
			$this->user = 'Привет'.' '.'гость,надо бы авторизоваться';
		}		
		
		//$this->a2 = A2::instance('a2'); Это почему-то не работает	
		
		//$this->auth = $this->a2->a1;Это почему-то не работает
		//$this->user = $this->a2->get_user();Это почему-то не работает
	} 
	
	/**
	 * Выполняется после загрузки основного контрола (шаблона) web-сайта.
	 * @see Kohana_Controller_Template::after()
	 */
	public function after() {
	
	
	
		// Если включен автоматический рендеринг
		if ($this->auto_render)
		{
			// Получаем маршрут к папке Media
			$media = Route::get('media');
			// Добавляем стили, используемые на каждой странице web-сайта
			$styles = array(
				$media->uri(array('file' => 'css/jquery-ui.css')) => 'screen',
				$media->uri(array('file' => 'css/mainCSS.css')) => 'screen'
			);
			// Добавляем скрипты, используемые на каждой странице web-сайта
			$scripts = array(
				$media->uri(array('file' => 'js/jquery.min.js')),
				$media->uri(array('file' => 'js/jquery-ui.min.js')),
			);
		}
		// Assign variables to template variables
		$this->template->scripts = Arr::merge($scripts, $this->scripts);
		$this->template->styles = Arr::merge($styles, $this->styles);
		$this->template->title = $this->title;
		$this->template->user = $this->user;
		$this->template->content = $this->content;
		
			
		// вызываем родительский метод
		parent::after();
	}
		
	
}


?>