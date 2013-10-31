-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Окт 30 2013 г., 22:44
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `cos3`
--

-- --------------------------------------------------------

--
-- Структура таблицы `delivery_times`
--

CREATE TABLE IF NOT EXISTS `delivery_times` (
  `delivery_id` int(10) NOT NULL AUTO_INCREMENT,
  `delivery_time` time NOT NULL,
  `delivery_limit` int(11) NOT NULL,
  PRIMARY KEY (`delivery_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `delivery_times`
--

INSERT INTO `delivery_times` (`delivery_id`, `delivery_time`, `delivery_limit`) VALUES
(1, '20:20:20', 30);

-- --------------------------------------------------------

--
-- Структура таблицы `dishes`
--

CREATE TABLE IF NOT EXISTS `dishes` (
  `dish_id` int(10) NOT NULL AUTO_INCREMENT,
  `dish_name` varchar(20) NOT NULL,
  `dish_type_id` int(10) NOT NULL,
  `dish_category_id` int(11) NOT NULL,
  `is_standart` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`dish_id`),
  KEY `FKdishes824954` (`dish_type_id`),
  KEY `FKdishes544074` (`dish_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `dish_category`
--

CREATE TABLE IF NOT EXISTS `dish_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `priority` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `dish_portion`
--

CREATE TABLE IF NOT EXISTS `dish_portion` (
  `dish_id` int(10) NOT NULL,
  `portion_type_id` int(10) NOT NULL,
  KEY `FKdish_porti275882` (`dish_id`),
  KEY `FKdish_porti532376` (`portion_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `dish_type`
--

CREATE TABLE IF NOT EXISTS `dish_type` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `ingredients`
--

CREATE TABLE IF NOT EXISTS `ingredients` (
  `dish_Id` int(10) NOT NULL,
  `product_Id` int(10) NOT NULL,
  `yield` double NOT NULL,
  PRIMARY KEY (`dish_Id`,`product_Id`),
  KEY `FKingredient247026` (`dish_Id`),
  KEY `FKingredient535850` (`product_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `menus`
--

CREATE TABLE IF NOT EXISTS `menus` (
  `menu_id` int(5) NOT NULL AUTO_INCREMENT,
  `menu_date` date NOT NULL,
  PRIMARY KEY (`menu_id`),
  UNIQUE KEY `menu_date` (`menu_date`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `menus`
--

INSERT INTO `menus` (`menu_id`, `menu_date`) VALUES
(1, '2013-10-30');

-- --------------------------------------------------------

--
-- Структура таблицы `menu_buttons`
--

CREATE TABLE IF NOT EXISTS `menu_buttons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `name_link` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `menu_buttons`
--

INSERT INTO `menu_buttons` (`id`, `name`, `name_link`) VALUES
(1, '/admin ', 'Администрирование'),
(2, '/admin/users', 'Пользователи'),
(3, '/menu', 'Меню'),
(4, '/order', 'Заказы');

-- --------------------------------------------------------

--
-- Структура таблицы `menu_records`
--

CREATE TABLE IF NOT EXISTS `menu_records` (
  `menu_id` int(5) NOT NULL,
  `dish_id` int(10) NOT NULL,
  `price` double NOT NULL,
  PRIMARY KEY (`menu_id`,`dish_id`),
  KEY `FKmenu_recor596691` (`menu_id`),
  KEY `FKmenu_recor558008` (`dish_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `delivery_times_delivery_id` int(10) NOT NULL,
  `order_date` date NOT NULL,
  `delivery_date` date NOT NULL,
  `delivery_point` varchar(255) NOT NULL,
  `order_status` varchar(20) NOT NULL DEFAULT 'Not Staffed',
  `total_price` decimal(5,2) DEFAULT NULL,
  `subscription_subs_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`order_id`),
  KEY `FKorders322301` (`user_id`),
  KEY `FKorders354629` (`subscription_subs_id`),
  KEY `FKorders486885` (`delivery_times_delivery_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `delivery_times_delivery_id`, `order_date`, `delivery_date`, `delivery_point`, `order_status`, `total_price`, `subscription_subs_id`) VALUES
(1, 1, 1, '2022-10-20', '2025-10-20', 'Офис 5', 'Размещен', '120.00', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `orders_records`
--

CREATE TABLE IF NOT EXISTS `orders_records` (
  `order_id` int(10) NOT NULL,
  `menu_record_menu_id` int(5) NOT NULL,
  `menu_record_dish_id` int(10) NOT NULL,
  `servings_number` int(3) NOT NULL,
  PRIMARY KEY (`order_id`,`menu_record_menu_id`,`menu_record_dish_id`),
  KEY `FKorders_rec398980` (`order_id`),
  KEY `FKorders_rec170609` (`menu_record_menu_id`,`menu_record_dish_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `portion_type`
--

CREATE TABLE IF NOT EXISTS `portion_type` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(10) NOT NULL,
  `weight` float NOT NULL,
  `dimension` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(10) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(20) NOT NULL,
  `balance` double NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'login');

-- --------------------------------------------------------

--
-- Структура таблицы `roles_buttons`
--

CREATE TABLE IF NOT EXISTS `roles_buttons` (
  `roles_role_Id` int(10) NOT NULL,
  `menu_buttons_id` int(11) NOT NULL,
  PRIMARY KEY (`roles_role_Id`,`menu_buttons_id`),
  KEY `FKroles_butt442610` (`roles_role_Id`),
  KEY `FKroles_butt17717` (`menu_buttons_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `roles_buttons`
--

INSERT INTO `roles_buttons` (`roles_role_Id`, `menu_buttons_id`) VALUES
(1, 1),
(1, 2),
(2, 3),
(2, 4);

-- --------------------------------------------------------

--
-- Структура таблицы `roles_users`
--

CREATE TABLE IF NOT EXISTS `roles_users` (
  `role_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  KEY `FKroles_user886729` (`role_id`),
  KEY `FKroles_user949729` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `roles_users`
--

INSERT INTO `roles_users` (`role_id`, `user_id`) VALUES
(2, 1),
(1, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `subscriptions`
--

CREATE TABLE IF NOT EXISTS `subscriptions` (
  `subs_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`subs_id`),
  KEY `FKsubscripti816647` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `employee_number` int(10) DEFAULT NULL,
  `payment_type` tinyint(1) NOT NULL DEFAULT '0',
  `discount` int(2) DEFAULT NULL,
  `user_status` tinyint(4) DEFAULT NULL,
  `logins` int(10) NOT NULL DEFAULT '0',
  `last_login` int(10) DEFAULT NULL,
  `surname` varchar(20) DEFAULT NULL,
  `patronymic` varchar(255) DEFAULT NULL,
  `floor` varchar(11) NOT NULL,
  `office` varchar(20) NOT NULL,
  `building` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `name`, `employee_number`, `payment_type`, `discount`, `user_status`, `logins`, `last_login`, `surname`, `patronymic`, `floor`, `office`, `building`) VALUES
(1, 'administrator', 'e24c2ae5d2a72710f7a05306e24f1f13cf6feb9c4c80e7c44f47cdf4bc5be9af', 'babur4iK@rambler.ru', 'Дмитрий', 111111, 0, NULL, 0, 0, 1383158485, 'Бабурин', 'Владимирович', '2', '4', '5'),
(2, 'baburin', 'e24c2ae5d2a72710f7a05306e24f1f13cf6feb9c4c80e7c44f47cdf4bc5be9af', 'baburin@yabddex.ru', 'Хоченков', 222222, 0, NULL, 0, 0, 1383156614, 'Алексей', 'Евгеньевич', '22', '22', '22');

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `dishes`
--
ALTER TABLE `dishes`
  ADD CONSTRAINT `FKdishes544074` FOREIGN KEY (`dish_category_id`) REFERENCES `dish_category` (`id`),
  ADD CONSTRAINT `FKdishes824954` FOREIGN KEY (`dish_type_id`) REFERENCES `dish_type` (`id`);

--
-- Ограничения внешнего ключа таблицы `dish_portion`
--
ALTER TABLE `dish_portion`
  ADD CONSTRAINT `FKdish_porti275882` FOREIGN KEY (`dish_id`) REFERENCES `dishes` (`dish_id`),
  ADD CONSTRAINT `FKdish_porti532376` FOREIGN KEY (`portion_type_id`) REFERENCES `portion_type` (`id`);

--
-- Ограничения внешнего ключа таблицы `ingredients`
--
ALTER TABLE `ingredients`
  ADD CONSTRAINT `FKingredient247026` FOREIGN KEY (`dish_Id`) REFERENCES `dishes` (`dish_id`),
  ADD CONSTRAINT `FKingredient535850` FOREIGN KEY (`product_Id`) REFERENCES `products` (`product_id`);

--
-- Ограничения внешнего ключа таблицы `menu_records`
--
ALTER TABLE `menu_records`
  ADD CONSTRAINT `FKmenu_recor558008` FOREIGN KEY (`dish_id`) REFERENCES `dishes` (`dish_id`),
  ADD CONSTRAINT `FKmenu_recor596691` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`menu_id`);

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FKorders322301` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `FKorders354629` FOREIGN KEY (`subscription_subs_id`) REFERENCES `subscriptions` (`subs_id`),
  ADD CONSTRAINT `FKorders486885` FOREIGN KEY (`delivery_times_delivery_id`) REFERENCES `delivery_times` (`delivery_id`);

--
-- Ограничения внешнего ключа таблицы `orders_records`
--
ALTER TABLE `orders_records`
  ADD CONSTRAINT `FKorders_rec170609` FOREIGN KEY (`menu_record_menu_id`, `menu_record_dish_id`) REFERENCES `menu_records` (`menu_id`, `dish_id`),
  ADD CONSTRAINT `FKorders_rec398980` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);

--
-- Ограничения внешнего ключа таблицы `roles_buttons`
--
ALTER TABLE `roles_buttons`
  ADD CONSTRAINT `FKroles_butt17717` FOREIGN KEY (`menu_buttons_id`) REFERENCES `menu_buttons` (`id`),
  ADD CONSTRAINT `FKroles_butt442610` FOREIGN KEY (`roles_role_Id`) REFERENCES `roles` (`id`);

--
-- Ограничения внешнего ключа таблицы `roles_users`
--
ALTER TABLE `roles_users`
  ADD CONSTRAINT `FKroles_user886729` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `FKroles_user949729` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD CONSTRAINT `FKsubscripti816647` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
