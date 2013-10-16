<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Перевод правил валидации на понятный язык
 */
return array
(		
	'password'	=> 	array(			
    'not_empty' => 'Не введен пароль',
    'min_length' => 'Пароль должен содержать 6 символов',
    'Model_Valid::preg_match'=>'Пароль не должен содержать иных символов, кроме латиницы, цифр и некоторых спецсимволов ("_-!?*#$%&+")',
   	'max_length' => 'Пароль не должен превышать 16 символов',	
	'Model_Valid::login_valid'=>'Пароль не должен совпадать с логином',
		 			),
			
	'surname'	=> 	array(
				'not_empty' => 'Не введена фамилия',				
		),
		
	'name'	=> 	array(
				'not_empty' => 'Не введено имя',
		),
		
	'patronymic'	=> 	array(
				'not_empty' => 'Не введено отчество',
		),
		
	'building'	=> 	array(
				'not_empty' => 'Не введено здание',
		),		

	'floors'	=> 	array(
				'not_empty' => 'Не введен этаж',
		),
		
	
	'num_office'	=> 	array(
				'not_empty' => 'Не введен номер кабинета',
		),
		
	'personnel_number'	=> 	array(
				'not_empty' => 'Не введен табельный номер',
			'Model_Valid::tab_number'=> 'Неккоректный табельный номер: он имеет значения 6 символов с 100000 по 999999',
			'Model_Valid::tab_number_unique'=>'Такой табельный номер уже существует',
			'digit'=>'Введеные числа могут быть только целыми ',
			'max_length' => 'табельный номер должен содержать не более 6 символов',
		),	
		
	'username'	=> 	array(
	'not_empty' => 'Не введен логин', 
	'alpha_dash'=>'В логине должны содержаться только цифры, латинские буквы и дефисы' ,
	'min_length' => 'Логин должен минимум содержать 6 символов',
	'max_length' => 'Логин должен содержать максимум 16 символов',
	'Model_Valid::user_unique'=>' Такой логин уже существует'),
	
	'email'	=> 	array(
	'not_empty' => 'Не введен email', 
	'email'=>'E-mail имеет неправильный формат: username@hostname.domain' ,
	'Model_Valid::email_unique'=>' Такой email уже существует'),
		
		'password_confirm'=>array(
	'not_empty' => 'Вы не подтвердили пароль', 
	'matches'=>'Пароль должен быть совпадать с полем подтвердения пароля' ),
	
);