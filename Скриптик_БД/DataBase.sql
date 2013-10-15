-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Окт 15 2013 г., 18:24
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `1`
--

-- --------------------------------------------------------

--
-- Структура таблицы `deliverytimes`
--

CREATE TABLE IF NOT EXISTS `deliverytimes` (
  `DeliveryId` int(10) NOT NULL AUTO_INCREMENT,
  `DeliveryTime` time NOT NULL,
  `DeliveryLimit` int(11) NOT NULL,
  PRIMARY KEY (`DeliveryId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `deliverytimes`
--

INSERT INTO `deliverytimes` (`DeliveryId`, `DeliveryTime`, `DeliveryLimit`) VALUES
(1, '00:00:11', 11);

-- --------------------------------------------------------

--
-- Структура таблицы `dishes`
--

CREATE TABLE IF NOT EXISTS `dishes` (
  `DishId` int(10) NOT NULL AUTO_INCREMENT,
  `DishName` varchar(20) NOT NULL,
  `Type` varchar(10) NOT NULL,
  PRIMARY KEY (`DishId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `ingredients`
--

CREATE TABLE IF NOT EXISTS `ingredients` (
  `DishDishId` int(10) NOT NULL,
  `ProductProductId` int(10) NOT NULL,
  `yield` double NOT NULL,
  PRIMARY KEY (`DishDishId`,`ProductProductId`),
  KEY `FKIngredient645192` (`DishDishId`),
  KEY `FKIngredient951298` (`ProductProductId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `menubuttons`
--

CREATE TABLE IF NOT EXISTS `menubuttons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `menues`
--

CREATE TABLE IF NOT EXISTS `menues` (
  `MenuId` int(5) NOT NULL AUTO_INCREMENT,
  `MenuDate` date NOT NULL,
  `Type` varchar(10) NOT NULL,
  PRIMARY KEY (`MenuId`),
  UNIQUE KEY `MenuDate` (`MenuDate`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `menurecords`
--

CREATE TABLE IF NOT EXISTS `menurecords` (
  `MenuId` int(5) NOT NULL,
  `DishId` int(10) NOT NULL,
  `TotalPortions` int(3) NOT NULL,
  `Price` double NOT NULL,
  PRIMARY KEY (`MenuId`,`DishId`),
  KEY `FKMenuRecord794087` (`MenuId`),
  KEY `FKMenuRecord681302` (`DishId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `OrderId` int(10) NOT NULL AUTO_INCREMENT,
  `UserId` int(10) NOT NULL,
  `DeliveryTimesDeliveryId` int(10) NOT NULL,
  `OrderDate` date NOT NULL,
  `DeliveryDate` date NOT NULL,
  `DeliveryPoint` varchar(10) NOT NULL,
  `OrderStatus` varchar(20) NOT NULL DEFAULT 'Not Staffed',
  `TotalPrice` decimal(5,2) DEFAULT NULL,
  `SubscriptionSubsId` int(10) DEFAULT NULL,
  PRIMARY KEY (`OrderId`),
  KEY `FKOrders930409` (`UserId`),
  KEY `FKOrders579408` (`SubscriptionSubsId`),
  KEY `FKOrders640533` (`DeliveryTimesDeliveryId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`OrderId`, `UserId`, `DeliveryTimesDeliveryId`, `OrderDate`, `DeliveryDate`, `DeliveryPoint`, `OrderStatus`, `TotalPrice`, `SubscriptionSubsId`) VALUES
(2, 1, 1, '2013-10-01', '2013-10-02', '', 'Заказ_принят', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `ordersrecords`
--

CREATE TABLE IF NOT EXISTS `ordersrecords` (
  `OrderId` int(10) NOT NULL,
  `MenuRecordMenuId` int(5) NOT NULL,
  `MenuRecordDishId` int(10) NOT NULL,
  `ServingsNumber` int(3) NOT NULL,
  PRIMARY KEY (`OrderId`,`MenuRecordMenuId`,`MenuRecordDishId`),
  KEY `FKOrdersReco198862` (`OrderId`),
  KEY `FKOrdersReco354374` (`MenuRecordMenuId`,`MenuRecordDishId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `ProductId` int(10) NOT NULL AUTO_INCREMENT,
  `ProductName` varchar(20) NOT NULL,
  `Balance` double NOT NULL,
  PRIMARY KEY (`ProductId`)
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
-- Структура таблицы `rolesbuttons`
--

CREATE TABLE IF NOT EXISTS `rolesbuttons` (
  `RolesRoleId` int(10) NOT NULL,
  `menuButtonsid` int(11) NOT NULL,
  PRIMARY KEY (`RolesRoleId`,`menuButtonsid`),
  KEY `FKRolesButto163567` (`RolesRoleId`),
  KEY `FKRolesButto297520` (`menuButtonsid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `roles_users`
--

CREATE TABLE IF NOT EXISTS `roles_users` (
  `role_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  KEY `FKRoles_User121825` (`role_id`),
  KEY `FKRoles_User256956` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `roles_users`
--

INSERT INTO `roles_users` (`role_id`, `user_id`) VALUES
(1, 1),
(2, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `subscriptions`
--

CREATE TABLE IF NOT EXISTS `subscriptions` (
  `SubsId` int(10) NOT NULL AUTO_INCREMENT,
  `UsersUserId` int(10) NOT NULL,
  `StartDate` date NOT NULL,
  `EndDate` date DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`SubsId`),
  KEY `FKSubscripti750367` (`UsersUserId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `subscriptions`
--

INSERT INTO `subscriptions` (`SubsId`, `UsersUserId`, `StartDate`, `EndDate`, `status`) VALUES
(1, 1, '2013-10-07', '2013-10-08', NULL);

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
  `PaymentType` bit(1) NOT NULL DEFAULT b'0',
  `Discount` int(2) DEFAULT NULL,
  `UserStatus` tinyint(1) DEFAULT NULL,
  `logins` int(10) NOT NULL DEFAULT '0',
  `last_login` int(10) DEFAULT NULL,
  `building` varchar(50) DEFAULT NULL,
  `floors` int(100) DEFAULT NULL,
  `num_office` int(255) DEFAULT NULL,
  `personnel_number` int(255) DEFAULT NULL,
  `surname` varchar(255) DEFAULT NULL,
  `patronymic` varchar(255) DEFAULT NULL,
  `delivery` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `name`, `PaymentType`, `Discount`, `UserStatus`, `logins`, `last_login`, `building`, `floors`, `num_office`, `personnel_number`, `surname`, `patronymic`, `delivery`) VALUES
(1, 'admin', '987ce3d883fe34262fffc2ccb18f480128eae9a3b17411999e6ab124328550bc', 'babur@ya.ru', 'Дмитрий', b'1', NULL, 0, 8, 1381846274, '5Б', 1, 38, 111111, 'Бабурин', 'Владимирович', NULL);

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `ingredients`
--
ALTER TABLE `ingredients`
  ADD CONSTRAINT `FKIngredient645192` FOREIGN KEY (`DishDishId`) REFERENCES `dishes` (`DishId`),
  ADD CONSTRAINT `FKIngredient951298` FOREIGN KEY (`ProductProductId`) REFERENCES `products` (`ProductId`);

--
-- Ограничения внешнего ключа таблицы `menurecords`
--
ALTER TABLE `menurecords`
  ADD CONSTRAINT `FKMenuRecord681302` FOREIGN KEY (`DishId`) REFERENCES `dishes` (`DishId`),
  ADD CONSTRAINT `FKMenuRecord794087` FOREIGN KEY (`MenuId`) REFERENCES `menues` (`MenuId`);

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FKOrders579408` FOREIGN KEY (`SubscriptionSubsId`) REFERENCES `subscriptions` (`SubsId`),
  ADD CONSTRAINT `FKOrders640533` FOREIGN KEY (`DeliveryTimesDeliveryId`) REFERENCES `deliverytimes` (`DeliveryId`),
  ADD CONSTRAINT `FKOrders930409` FOREIGN KEY (`UserId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `ordersrecords`
--
ALTER TABLE `ordersrecords`
  ADD CONSTRAINT `FKOrdersReco198862` FOREIGN KEY (`OrderId`) REFERENCES `orders` (`OrderId`),
  ADD CONSTRAINT `FKOrdersReco354374` FOREIGN KEY (`MenuRecordMenuId`, `MenuRecordDishId`) REFERENCES `menurecords` (`MenuId`, `DishId`);

--
-- Ограничения внешнего ключа таблицы `rolesbuttons`
--
ALTER TABLE `rolesbuttons`
  ADD CONSTRAINT `FKRolesButto163567` FOREIGN KEY (`RolesRoleId`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `FKRolesButto297520` FOREIGN KEY (`menuButtonsid`) REFERENCES `menubuttons` (`id`);

--
-- Ограничения внешнего ключа таблицы `roles_users`
--
ALTER TABLE `roles_users`
  ADD CONSTRAINT `FKRoles_User121825` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `FKRoles_User256956` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD CONSTRAINT `FKSubscripti750367` FOREIGN KEY (`UsersUserId`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
