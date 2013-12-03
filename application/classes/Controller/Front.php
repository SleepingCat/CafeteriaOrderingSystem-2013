<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Главный контрол web-сайта, представляющий основной шаблон страницы.
 * @author Sergey S. Smirnov
 * @see Kohana_Controller_Template
 */
class Controller_Front extends Kohana_Controller_Template {
	
	/**
	 * Хранит сессию данного подключения
	 */
	public $session = null;
	/**
	 * Относительный путь к шаблону web-страницы.
	 * @var string
	 */
	public $template = '';
	/**
	 * Выводимое сообщение.
	 */
	public $message = '';
	/**
	 * 
	 * Переменная панели навигации
	 */
	public $menu = array();
	/**
	 *
	 * Переменная главной панели навигации
	 */
	public $main_menu = array();
	/**
	 * Содержимое текущей web-страницы.
	 * @var string
	 */	
	public $content = '';
	/**
	 * Переменная гость
	 * @var unknown
	 */
	public $guest = '';
	/**
	 * Пути к подключаемым JavaScript'ам.
	 * @var Array
	 *
	 **/
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
		
		// Запускаем сессию
		$this->session = Session::instance();
		
		// Получаем информацию о текущем пользователе
		if(Auth::instance()->logged_in())
		{
     		$this->user = Auth::instance()->get_user()->as_array();
			$this->user_hello = View::factory('templates/profileview')->set('user',$this->user['surname'].' '.$this->user['name'].' '.$this->user['patronymic']);
			
			// Создаем экземпляр модели
			$link=new Model_Link();			
			// Присваем переменной $links , ссылку и название ссылки
			$links=$link->get_link($this->user['username'], -2);
			$result = "";
			$mainresult = "";
			foreach ($links as $item)
			{
				$result =$result.'<li class="LeftMenuItem"> <span class="LeftMenuHeader"><div class="TriangleClosed"></div>';
				$result =$result.'<span>'.$item['name_link'].'</span></span><ul class="LeftBlockMenu">';
				$linksChild=$link->get_link($this->user['username'], $item['id']);
				if (isset($linksChild))
				{
					foreach ($linksChild as $itemChild)
					{
						$mainresult = $mainresult.'<li class="MainPanelItem"><span><a class="MainPanelButton" href="'.URL::site($itemChild['name']).'">';
						$mainresult = $mainresult.$itemChild['name_link'];
						$mainresult = $mainresult.'</a></span></li>';
						$result = $result.'<li><a class="NavLink" href="'.URL::site($itemChild['name']).'">';
						$result = $result.'<div class="TriangleLittle"></div>'.$itemChild['name_link'];
						$result = $result.'</a></li>';
					}
					$result = $result.'</ul></li>';
				}
			}
			$this->main_menu=$mainresult;			
			
			$links=$link->get_link($this->user['username'], -1);						
			foreach ($links as $item)	
			{
				$result =$result.'<li class="LeftMenuItem"> <span class="LeftMenuHeader"><div class="TriangleClosed"></div>';
				$result =$result.'<span>'.$item['name_link'].'</span></span><ul class="LeftBlockMenu">';
				$linksChild=$link->get_link($this->user['username'], $item['id']);
				if (isset($linksChild)) 
				{
				   foreach ($linksChild as $itemChild)
				   {
				    	$result = $result.'<li><a class="NavLink" href="'.URL::site($itemChild['name']).'">';
			    		$result = $result.'<div class="TriangleLittle"></div>'.$itemChild['name_link'];
				    	$result = $result.'</a></li>';
				   }
				}
				$result = $result.'</ul></li>';
			}		
			$this->menu=$result;			
			
		}		
		else			
		{
			$this->user = "";
			$this->user_hello = View::factory('templates/profileview');
			$this->guest="Гость";
			$this->menu="";	
			
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
				//$media->uri(array('file' => 'css/jquery-ui.css')) => 'screen',
				$media->uri(array('file' => 'css/reset.css')) => 'screen',
				$media->uri(array('file' => 'css/mainCSS.css')) => 'screen',
				$media->uri(array('file' => 'css/buttons.css')) => 'screen',
				$media->uri(array('file' => 'css/elements.css')) => 'screen',
				$media->uri(array('file' => 'css/forms.css')) => 'screen',
				$media->uri(array('file' => 'css/jq-widgets.css')) => 'screen'
			);
			// Добавляем скрипты, используемые на каждой странице web-сайта
			$scripts = array(
				$media->uri(array('file' => 'js/jquery.min.js')),
				$media->uri(array('file' => 'js/jquery-ui.min.js')),
				$media->uri(array('file' => 'js/pxgradient-1.0.2.jquery.js')),
				$media->uri(array('file' => 'js/jquery.json-2.4.min.js')),
				$media->uri(array('file' => 'js/jquery.cookie.js')),
				$media->uri(array('file' => 'js/jquery.simplemodal.1.4.4.min.js')),				
				$media->uri(array('file' => 'js/mainScript.js')),
				$media->uri(array('file' => 'js/secondaryScript.js')),
				$media->uri(array('file' => 'js/elementsScript.js'))					
			);
		}
		// Assign variables to template variables
		//$this->message = "RL";
		$this->template->scripts = Arr::merge($scripts, $this->scripts);
		$this->template->styles = Arr::merge($styles, $this->styles);
		$this->template->message = $this->message;
		$this->template->title = $this->title;
		$this->template->user = $this->user_hello;
		$this->template->content = $this->content;
		$this->template->menu = $this->menu;
		$this->template->main_menu = $this->main_menu;
		$this->template->guest = $this->guest;
		
			
		// вызываем родительский метод
		parent::after();
	}
		
	
}


?>