-- phpMyAdmin SQL Dump
-- version 4.0.5
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3307
-- Время создания: Ноя 03 2013 г., 22:40
-- Версия сервера: 5.6.13-log
-- Версия PHP: 5.4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Дамп данных таблицы `delivery_times`
--

INSERT INTO `delivery_times` (`delivery_id`, `delivery_time`, `delivery_limit`) VALUES
(1, '11:00:00', 10),
(2, '11:15:00', 10),
(3, '11:30:00', 10),
(4, '11:45:00', 10),
(5, '12:00:00', 20),
(6, '12:15:00', 20),
(7, '12:30:00', 20),
(8, '12:45:00', 20),
(9, '13:00:00', 20),
(10, '13:15:00', 20),
(11, '13:30:00', 20),
(12, '13:45:00', 10),
(13, '14:00:00', 10),
(14, '14:15:00', 10),
(15, '14:30:00', 10);

-- --------------------------------------------------------

--
-- Структура таблицы `dishes`
--

CREATE TABLE IF NOT EXISTS `dishes` (
  `dish_id` int(10) NOT NULL AUTO_INCREMENT,
  `dish_name` varchar(60) NOT NULL,
  `dish_type_id` int(10) NOT NULL,
  `dish_category_id` int(11) NOT NULL,
  `is_standart` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`dish_id`),
  KEY `FKdishes824954` (`dish_type_id`),
  KEY `FKdishes544074` (`dish_category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `dishes`
--

INSERT INTO `dishes` (`dish_id`, `dish_name`, `dish_type_id`, `dish_category_id`, `is_standart`) VALUES
(1, 'Суп из кука', 1, 1, 1),
(2, 'Суп бараний', 2, 1, 0),
(3, 'Рагу свиное', 2, 3, 1),
(4, 'Компот из яблок с перцем', 2, 4, 0),
(5, 'Вино шато совьньен', 7, 6, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `dish_category`
--

CREATE TABLE IF NOT EXISTS `dish_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `priority` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Дамп данных таблицы `dish_category`
--

INSERT INTO `dish_category` (`id`, `name`, `priority`) VALUES
(1, 'Супы', 1),
(2, 'Закуски', 2),
(3, 'Горячее', 3),
(4, 'Напитки безалкогольн', 4),
(5, 'Вина', 5),
(6, 'Пиво', 6),
(12, 'Шампанское', 10),
(13, 'Белые вина', 10),
(14, 'Розовые вина', 10),
(15, 'Красные вина', 10),
(16, 'Ликеры', 10),
(17, 'Коньяк', 10),
(18, 'Кальвадос', 10),
(19, 'Бренди', 10),
(20, 'Виски', 10),
(21, 'Ром', 10),
(22, 'Джин', 10),
(23, 'Текила', 10),
(24, 'Водка', 10);

-- --------------------------------------------------------

--
-- Структура таблицы `dish_type`
--

CREATE TABLE IF NOT EXISTS `dish_type` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `dish_type`
--

INSERT INTO `dish_type` (`id`, `name`) VALUES
(1, 'Стандартное'),
(2, 'Кафетерий'),
(3, 'Ресторан "Иваси"'),
(4, 'Ресторан "Япония"'),
(5, 'Коктебель'),
(6, 'Масандра'),
(7, 'Шато');

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

--
-- Дамп данных таблицы `ingredients`
--

INSERT INTO `ingredients` (`dish_Id`, `product_Id`, `yield`) VALUES
(1, 1, 2),
(1, 2, 1),
(1, 3, 1),
(1, 4, 2),
(2, 3, 1),
(2, 4, 2),
(2, 5, 1),
(2, 6, 7),
(3, 1, 2),
(3, 4, 1),
(3, 7, 1),
(4, 3, 2),
(4, 5, 6),
(4, 8, 1),
(5, 3, 4),
(5, 7, 1),
(5, 10, 2),
(5, 11, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `menus`
--

CREATE TABLE IF NOT EXISTS `menus` (
  `menu_id` int(5) NOT NULL AUTO_INCREMENT,
  `menu_date` date NOT NULL,
  PRIMARY KEY (`menu_id`),
  UNIQUE KEY `menu_date` (`menu_date`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `menus`
--

INSERT INTO `menus` (`menu_id`, `menu_date`) VALUES
(1, '2013-11-07'),
(2, '2013-11-08'),
(3, '2013-11-14');

-- --------------------------------------------------------

--
-- Структура таблицы `menu_buttons`
--

CREATE TABLE IF NOT EXISTS `menu_buttons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `name_link` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `menu_buttons`
--

INSERT INTO `menu_buttons` (`id`, `name`, `name_link`) VALUES
(1, '/admin', 'Администрирование'),
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
  `portion_type_id` int(10) NOT NULL,
  PRIMARY KEY (`menu_id`,`dish_id`,`portion_type_id`),
  KEY `FKmenu_recor596691` (`menu_id`),
  KEY `FKmenu_recor558008` (`dish_id`),
  KEY `FKmenu_recor698485` (`portion_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `menu_records`
--

INSERT INTO `menu_records` (`menu_id`, `dish_id`, `price`, `portion_type_id`) VALUES
(1, 1, 100, 1),
(1, 1, 150, 2),
(1, 2, 150, 2),
(1, 3, 11, 2),
(1, 3, 180, 3),
(2, 1, 150, 1),
(2, 2, 150, 1),
(2, 3, 160, 1),
(2, 4, 10, 1),
(2, 4, 15, 2),
(2, 4, 20, 3),
(3, 1, 160, 1),
(3, 1, 200, 4),
(3, 2, 150, 2),
(3, 2, 100, 3),
(3, 3, 12, 1),
(3, 3, 15, 2),
(3, 4, 100, 1),
(3, 5, 16, 1),
(3, 5, 111, 4);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `delivery_times_delivery_id`, `order_date`, `delivery_date`, `delivery_point`, `order_status`, `total_price`, `subscription_subs_id`) VALUES
(2, 1, 5, '2013-10-20', '2013-10-30', 'none', 'NewOrder', '999.99', NULL),
(3, 1, 7, '2013-10-20', '2013-10-30', 'none', 'Canceled', '620.00', NULL),
(4, 2, 14, '2013-10-22', '2013-10-30', 'Здание 11 ', 'NewOrder', '270.00', NULL),
(5, 3, 12, '2013-10-23', '2013-10-30', 'none', 'NewOrder', '530.00', NULL),
(6, 2, 1, '2013-10-23', '2013-10-30', 'none', 'NewOrder', '360.00', NULL),
(7, 3, 7, '2013-10-23', '2013-10-30', 'Здание 3 Э', 'NewOrder', '220.00', NULL),
(8, 1, 2, '2013-10-23', '2013-10-30', 'Здание 5б ', 'Canceled', '540.00', NULL),
(9, 1, 1, '2013-10-23', '2013-10-30', 'none', 'NewOrder', '380.00', NULL),
(10, 1, 1, '2013-10-23', '2013-10-30', 'Здание 5б ', 'NewOrder', '250.00', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `orders_records`
--

CREATE TABLE IF NOT EXISTS `orders_records` (
  `order_id` int(10) NOT NULL,
  `menu_record_menu_id` int(5) NOT NULL,
  `menu_record_dish_id` int(10) NOT NULL,
  `servings_number` int(3) NOT NULL,
  `menu_record_portion_type_id` int(10) NOT NULL,
  PRIMARY KEY (`order_id`,`menu_record_menu_id`,`menu_record_dish_id`,`menu_record_portion_type_id`),
  KEY `FKorders_rec398980` (`order_id`),
  KEY `FKorders_rec170609` (`menu_record_menu_id`,`menu_record_dish_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders_records`
--

INSERT INTO `orders_records` (`order_id`, `menu_record_menu_id`, `menu_record_dish_id`, `servings_number`, `menu_record_portion_type_id`) VALUES
(2, 1, 1, 4, 1),
(2, 1, 2, 2, 1),
(2, 1, 2, 3, 2),
(3, 1, 1, 1, 1),
(3, 1, 2, 1, 1),
(3, 1, 2, 3, 2),
(5, 2, 1, 1, 1),
(5, 3, 1, 1, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `portion_type`
--

INSERT INTO `portion_type` (`id`, `type_name`, `weight`, `dimension`) VALUES
(1, 'Малая', 100, 'г'),
(2, 'Средняя', 200, 'г'),
(3, 'Большая', 500, 'г'),
(4, 'Огромная', 700, 'г');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(10) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(20) NOT NULL,
  `balance` double NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `balance`) VALUES
(1, 'Морковь', 150),
(2, 'Капуста', 100),
(3, 'Соль', 100),
(4, 'Укроп', 150),
(5, 'Петрушка', 200),
(6, 'Баранина', 152),
(7, 'Свинина', 100),
(8, 'Кукятина', 1),
(9, 'Перец черный', 22),
(10, 'Макароны Макфа', 55),
(11, 'Сахар', 100);

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
(1, 1),
(2, 1),
(2, 2),
(2, 3),
(2, 5);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `subscriptions`
--

INSERT INTO `subscriptions` (`subs_id`, `user_id`, `start_date`, `end_date`, `status`) VALUES
(1, 1, '2013-10-01', '2013-10-02', 'Действует');

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
  `payment_type` tinyint(4) NOT NULL DEFAULT '0',
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `name`, `employee_number`, `payment_type`, `discount`, `user_status`, `logins`, `last_login`, `surname`, `patronymic`, `floor`, `office`, `building`) VALUES
(1, 'administrator', '987ce3d883fe34262fffc2ccb18f480128eae9a3b17411999e6ab124328550bc', 'babur4iK@rambler.ru', 'Дмитрий', 111111, 1, NULL, 0, 16, 1382638819, 'Бабурин', 'Владимирович', '1', '38', '5б'),
(2, 'Xochenkov', 'e24c2ae5d2a72710f7a05306e24f1f13cf6feb9c4c80e7c44f47cdf4bc5be9af', 'xochenkov@rambler.ru', 'Алексей', 222222, 1, NULL, 0, 10, 1382546568, 'Хоченков', 'Евгеньевич', '4', '7', '11'),
(3, 'Umnov', 'e24c2ae5d2a72710f7a05306e24f1f13cf6feb9c4c80e7c44f47cdf4bc5be9af', 'umnov@oe-it.ru', 'Денис', 343, 0, 0, 0, 3, 1382535564, 'Умнов', 'Михайлович', '2', '1', '3'),
(5, 'galogen', '29cc30615f2e74ed6b333e127239d2c4ac4c363a6f51232422f3675bbb0f2a14', 'galogenIt@gmail.com', 'Эдуард ', 111112, 0, NULL, 0, 1, 1382639250, 'Галиаскаров', 'Геннадьевич', '2', '33', '6');

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
-- Ограничения внешнего ключа таблицы `ingredients`
--
ALTER TABLE `ingredients`
  ADD CONSTRAINT `FKingredient535850` FOREIGN KEY (`product_Id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `FKingredient247026` FOREIGN KEY (`dish_Id`) REFERENCES `dishes` (`dish_id`);

--
-- Ограничения внешнего ключа таблицы `menu_records`
--
ALTER TABLE `menu_records`
  ADD CONSTRAINT `FKmenu_recor558008` FOREIGN KEY (`dish_id`) REFERENCES `dishes` (`dish_id`),
  ADD CONSTRAINT `FKmenu_recor596691` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`menu_id`),
  ADD CONSTRAINT `FKmenu_recor698485` FOREIGN KEY (`portion_type_id`) REFERENCES `portion_type` (`id`);

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FKorders486885` FOREIGN KEY (`delivery_times_delivery_id`) REFERENCES `delivery_times` (`delivery_id`),
  ADD CONSTRAINT `FKorders322301` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `FKorders354629` FOREIGN KEY (`subscription_subs_id`) REFERENCES `subscriptions` (`subs_id`);

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
  ADD CONSTRAINT `FKroles_user949729` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FKroles_user886729` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Ограничения внешнего ключа таблицы `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD CONSTRAINT `FKsubscripti816647` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
