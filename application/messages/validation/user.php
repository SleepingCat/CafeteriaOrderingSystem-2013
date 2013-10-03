<?
return array
	(		
		'username'	=> 	array(
			'unique'	=>	'Данный логин уже занят',
			'not_empty' => 'Не введен логин',
					),
		'email'	=> 	array(
			'unique'	=>	'Данный email уже занят',
			'not_empty' => 'Не введен email',
			'email'=> 'Введенный email имеет не правильный формат',
				
		),
			'password'	=> 	array(			
		  'not_empty' => 'Не введен пароль',
		 			),	
			
			
	);