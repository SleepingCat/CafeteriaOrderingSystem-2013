-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Ноя 13 2013 г., 23:05
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `cos8`
--

-- --------------------------------------------------------

--
-- Структура таблицы `actions`
--

CREATE TABLE IF NOT EXISTS `actions` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nameAction` varchar(50) NOT NULL,
  `nameControl` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
  `is_available` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`dish_id`),
  KEY `FKdishes824954` (`dish_type_id`),
  KEY `FKdishes544074` (`dish_category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Дамп данных таблицы `dishes`
--

INSERT INTO `dishes` (`dish_id`, `dish_name`, `dish_type_id`, `dish_category_id`, `is_standart`, `is_available`) VALUES
(1, 'Борщ', 1, 1, 1, 1),
(2, 'Щи из свежей капусты', 2, 1, 0, 1),
(3, 'Рагу свиное', 1, 3, 1, 1),
(4, 'Азу из телятины', 2, 3, NULL, 1),
(5, 'Салат витаминные', 2, 2, 1, NULL),
(6, 'Салат морковный', 1, 2, 1, 1),
(7, 'Компот из сухофруктов', 2, 4, 1, 1),
(8, 'Пиво светлое', 2, 6, NULL, NULL);

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
  KEY `FKingredient247026` (`dish_Id`),
  KEY `FKingredient535850` (`product_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `ingredients`
--

INSERT INTO `ingredients` (`dish_Id`, `product_Id`, `yield`) VALUES
(1, 2, 111),
(1, 1, 112),
(1, 7, 13),
(3, 3, 13),
(3, 4, 13),
(2, 10, 13),
(5, 2, 11),
(3, 10, 44),
(7, 1, 14),
(2, 10, 145),
(5, 3, 112),
(2, 9, 14),
(5, 9, 11),
(1, 10, 14),
(5, 3, 5),
(2, 10, 55),
(4, 3, 12),
(2, 10, 145);

-- --------------------------------------------------------

--
-- Структура таблицы `menus`
--

CREATE TABLE IF NOT EXISTS `menus` (
  `menu_id` int(5) NOT NULL AUTO_INCREMENT,
  `menu_date` date NOT NULL,
  PRIMARY KEY (`menu_id`),
  UNIQUE KEY `menu_date` (`menu_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `menu_buttons`
--

CREATE TABLE IF NOT EXISTS `menu_buttons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(70) NOT NULL,
  `name_link` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Дамп данных таблицы `menu_buttons`
--

INSERT INTO `menu_buttons` (`id`, `name`, `name_link`) VALUES
(1, '/admin', 'Работа с учётными записями пользователей'),
(2, '/menu', 'Меню'),
(4, '/order', 'Заказы'),
(5, '/reestr', 'Реестр'),
(6, '/Userprofile', 'Мой профиль'),
(7, '/Subscription', 'Мои подписки'),
(8, '/CreateMenu', 'Создать меню'),
(9, '/ListIngr', 'Ингредиенты'),
(10, '/Reports', 'Отчеты'),
(11, '/Rezerv', 'Резервы времени'),
(12, '/QueryCost', 'Запрос на оплату'),
(13, '/Deliveryorders', 'Регистрировать доставку заказа блюд'),
(14, '/EquipOrder', 'Получить заказ для комплектования');

-- --------------------------------------------------------

--
-- Структура таблицы `menu_records`
--

CREATE TABLE IF NOT EXISTS `menu_records` (
  `menu_id` int(5) NOT NULL,
  `dish_id` int(10) NOT NULL,
  `portion_type_id` int(10) NOT NULL,
  `price` double NOT NULL,
  PRIMARY KEY (`menu_id`,`dish_id`,`portion_type_id`),
  KEY `FKmenu_recor596691` (`menu_id`),
  KEY `FKmenu_recor558008` (`dish_id`),
  KEY `FKmenu_recor698485` (`portion_type_id`)
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
  `total_price` decimal(10,2) DEFAULT NULL,
  `subscription_subs_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`order_id`),
  KEY `FKorders322301` (`user_id`),
  KEY `FKorders354629` (`subscription_subs_id`),
  KEY `FKorders486885` (`delivery_times_delivery_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `orders_records`
--

CREATE TABLE IF NOT EXISTS `orders_records` (
  `order_id` int(10) NOT NULL,
  `menu_record_menu_id` int(5) NOT NULL,
  `menu_record_dish_id` int(10) NOT NULL,
  `menu_record_portion_type_id` int(10) NOT NULL,
  `servings_number` int(3) NOT NULL,
  PRIMARY KEY (`order_id`,`menu_record_menu_id`,`menu_record_dish_id`,`menu_record_portion_type_id`),
  KEY `FKorders_rec398980` (`order_id`),
  KEY `FKorders_rec644380` (`menu_record_menu_id`,`menu_record_dish_id`,`menu_record_portion_type_id`)
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

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
(11, 'Сахар', 100),
(12, '2', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `rights`
--

CREATE TABLE IF NOT EXISTS `rights` (
  `roles_id` int(10) NOT NULL,
  `actions_id` int(10) NOT NULL,
  KEY `FKrights84148` (`roles_id`),
  KEY `FKrights123236` (`actions_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'login'),
(3, 'Комплектовщик'),
(5, 'Менеджер заказа'),
(4, 'Менеджер меню');

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
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(2, 2),
(2, 4),
(2, 6),
(2, 7),
(3, 4),
(3, 6),
(3, 14),
(4, 5),
(4, 6),
(4, 8),
(4, 9),
(4, 10),
(5, 2),
(5, 4),
(5, 6),
(5, 10),
(5, 11),
(5, 12),
(5, 13);

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
(2, 2),
(4, 2),
(2, 3),
(1, 3),
(2, 8),
(1, 8),
(2, 7),
(2, 6),
(5, 6),
(2, 9),
(3, 9);

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
  `date_change` date NOT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `date_change`, `name`, `employee_number`, `payment_type`, `discount`, `user_status`, `logins`, `last_login`, `surname`, `patronymic`, `floor`, `office`, `building`) VALUES
(1, 'administrator', '987ce3d883fe34262fffc2ccb18f480128eae9a3b17411999e6ab124328550bc', 'babur4iK@rambler.ru', '2013-09-03', 'Дмитрий', 111111, 1, NULL, 0, 30, 1384369322, 'Бабурин', 'Владимирович', '1', '38', '5б'),
(2, 'Xochenkov', '987ce3d883fe34262fffc2ccb18f480128eae9a3b17411999e6ab124328550bc', 'xochenkov@rambler.ru', '2013-10-01', 'Алексей', 222222, 1, NULL, 0, 14, 1384366391, 'Хоченков', 'Евгеньевич', '4', '7', '11'),
(3, 'UmnovDE', '987ce3d883fe34262fffc2ccb18f480128eae9a3b17411999e6ab124328550bc', 'umnov@oe-it.ru', '2013-09-03', 'Денис', 999999, 0, 0, 0, 4, 1384366412, 'Умнов', 'Михайлович', '2', '1', '3'),
(6, 'Sokolov', '987ce3d883fe34262fffc2ccb18f480128eae9a3b17411999e6ab124328550bc', 'sokolov@mail.ru', '2013-09-10', 'Владимир', 333333, 0, NULL, 0, 3, 1384369237, 'Соколов', 'Леонидович', '1', '1', '1'),
(7, 'Masalin', '987ce3d883fe34262fffc2ccb18f480128eae9a3b17411999e6ab124328550bc', 'masalin@gmail.com', '2013-09-10', 'Александр', 777777, 0, NULL, 0, 2, 1384368694, 'Масалин', 'Батькович', '1', '1', '1 '),
(8, 'galogen', '987ce3d883fe34262fffc2ccb18f480128eae9a3b17411999e6ab124328550bc', 'galogenIt@gmail.com', '2013-08-14', 'Эдуард', 555555, 1, NULL, 0, 1, 1384368017, 'Галиаскаров', 'Геннадьевич', '1', '1', '1'),
(9, 'Petrov', '987ce3d883fe34262fffc2ccb18f480128eae9a3b17411999e6ab124328550bc', 'petrov@gmail.com', '0000-00-00', 'Илья', 454545, 0, NULL, 0, 1, 1384369401, 'Петров', 'Евгеньевич', '2', '2', '2');

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
  ADD CONSTRAINT `FKingredient247026` FOREIGN KEY (`dish_Id`) REFERENCES `dishes` (`dish_id`),
  ADD CONSTRAINT `FKingredient535850` FOREIGN KEY (`product_Id`) REFERENCES `products` (`product_id`);

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
  ADD CONSTRAINT `FKorders322301` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `FKorders354629` FOREIGN KEY (`subscription_subs_id`) REFERENCES `subscriptions` (`subs_id`),
  ADD CONSTRAINT `FKorders486885` FOREIGN KEY (`delivery_times_delivery_id`) REFERENCES `delivery_times` (`delivery_id`);

--
-- Ограничения внешнего ключа таблицы `orders_records`
--
ALTER TABLE `orders_records`
  ADD CONSTRAINT `FKorders_rec398980` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `FKorders_rec644380` FOREIGN KEY (`menu_record_menu_id`, `menu_record_dish_id`, `menu_record_portion_type_id`) REFERENCES `menu_records` (`menu_id`, `dish_id`, `portion_type_id`);

--
-- Ограничения внешнего ключа таблицы `rights`
--
ALTER TABLE `rights`
  ADD CONSTRAINT `FKrights123236` FOREIGN KEY (`actions_id`) REFERENCES `actions` (`id`),
  ADD CONSTRAINT `FKrights84148` FOREIGN KEY (`roles_id`) REFERENCES `roles` (`id`);

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
