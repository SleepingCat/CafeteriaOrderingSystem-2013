<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Модель ,содержит метод для вытаскивания ссылок панели навигаци
 * 
 */
class Model_Link 
{	
	/**
	 * Возвращает cсылку,и название сслылки
	 * 
	 * @return $link
	 */
	public $link;
	public function get_link($username)
	{
		$auth = Auth::instance();
		
		if ($auth->logged_in('admin'))
		{
		
		return DB::query(Database::SELECT,		
		"select menu_buttons.name,menu_buttons.name_link from menu_buttons join roles_buttons on menu_buttons_id=menu_buttons.id join roles on roles.id=roles_buttons.roles_role_Id join roles_users on roles_users.role_id=roles_buttons.roles_role_Id
		join users on roles_users.user_id=users.id where users.username=:username and roles.name=:admin  order by  menu_buttons.name")
				->param(':username', $username)
				->param(':admin', 'admin')
				->execute()
				->as_array();		
		
		}
		
		if ($auth->logged_in('login'))
		{
		
			return DB::query(Database::SELECT,
			"select menu_buttons.name,menu_buttons.name_link from menu_buttons join roles_buttons on menu_buttons_id=menu_buttons.id join roles on roles.id=roles_buttons.roles_role_Id join roles_users on roles_users.role_id=roles_buttons.roles_role_Id
		join users on roles_users.user_id=users.id where users.username=:username and roles.name=:admin order by  menu_buttons.name")
				->param(':username', $username)
				->param(':admin', 'login')
				->execute()
				->as_array();
		
		}
	
		
	}	
}