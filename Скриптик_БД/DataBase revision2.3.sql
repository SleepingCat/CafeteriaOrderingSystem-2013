CREATE TABLE users (id int(10) NOT NULL AUTO_INCREMENT, username varchar(20) NOT NULL UNIQUE, password varchar(255) NOT NULL, email varchar(50) NOT NULL UNIQUE, name varchar(255) NOT NULL, employee_number int(10), payment_type tinyint DEFAULT 0 NOT NULL, discount int(2), user_status tinyint, logins int(10) DEFAULT 0 NOT NULL, last_login int(10) DEFAULT Null, surname varchar(20), patronymic varchar(255), floor varchar(11) NOT NULL, office varchar(20) NOT NULL, building varchar(20) NOT NULL, PRIMARY KEY (id));
CREATE TABLE orders (order_id int(10) NOT NULL AUTO_INCREMENT, user_id int(10) NOT NULL, delivery_times_delivery_id int(10) NOT NULL, order_date date NOT NULL, delivery_date date NOT NULL, delivery_point varchar(255) NOT NULL, order_status varchar(20) DEFAULT 'Not Staffed' NOT NULL, total_price numeric(5, 2), subscription_subs_id int(10), PRIMARY KEY (order_id));
CREATE TABLE orders_records (order_id int(10) NOT NULL, menu_record_menu_id int(5) NOT NULL, menu_record_dish_id int(10) NOT NULL, servings_number int(3) NOT NULL, PRIMARY KEY (order_id, menu_record_menu_id, menu_record_dish_id));
CREATE TABLE menus (menu_id int(5) NOT NULL AUTO_INCREMENT, menu_date date NOT NULL UNIQUE, PRIMARY KEY (menu_id));
CREATE TABLE menu_records (menu_id int(5) NOT NULL, dish_id int(10) NOT NULL, price double NOT NULL, PRIMARY KEY (menu_id, dish_id));
CREATE TABLE dishes (dish_id int(10) NOT NULL AUTO_INCREMENT, dish_name varchar(20) NOT NULL, dish_type_id int(10) NOT NULL, dish_category_id int(11) NOT NULL, is_standart tinyint, PRIMARY KEY (dish_id));
CREATE TABLE ingredients (dish_Id int(10) NOT NULL, product_Id int(10) NOT NULL, yield double NOT NULL, PRIMARY KEY (dish_Id, product_Id));
CREATE TABLE products (product_id int(10) NOT NULL AUTO_INCREMENT, product_name varchar(20) NOT NULL, balance double NOT NULL, PRIMARY KEY (product_id));
CREATE TABLE subscriptions (subs_id int(10) NOT NULL AUTO_INCREMENT, user_id int(10) NOT NULL, start_date date NOT NULL, end_date date, status varchar(10), PRIMARY KEY (subs_id));
CREATE TABLE roles (id int(10) NOT NULL AUTO_INCREMENT, name varchar(20) NOT NULL UNIQUE, PRIMARY KEY (id));
CREATE TABLE roles_users (role_id int(10) NOT NULL, user_id int(10) NOT NULL);
CREATE TABLE menu_buttons (id int(11) NOT NULL AUTO_INCREMENT, name varchar(10) NOT NULL, PRIMARY KEY (id));
CREATE TABLE roles_buttons (roles_role_Id int(10) NOT NULL, menu_buttons_id int(11) NOT NULL, PRIMARY KEY (roles_role_Id, menu_buttons_id));
CREATE TABLE delivery_times (delivery_id int(10) NOT NULL AUTO_INCREMENT, delivery_time time NOT NULL, delivery_limit int(11) NOT NULL, PRIMARY KEY (delivery_id));
CREATE TABLE dish_type (id int(10) NOT NULL AUTO_INCREMENT, name varchar(20) NOT NULL, PRIMARY KEY (id));
CREATE TABLE dish_category (id int(11) NOT NULL AUTO_INCREMENT, name varchar(20) NOT NULL, priority int(10) NOT NULL, PRIMARY KEY (id));
ALTER TABLE orders_records ADD INDEX FKorders_rec398980 (order_id), ADD CONSTRAINT FKorders_rec398980 FOREIGN KEY (order_id) REFERENCES orders (order_id);
ALTER TABLE orders ADD INDEX FKorders322301 (user_id), ADD CONSTRAINT FKorders322301 FOREIGN KEY (user_id) REFERENCES users (id);
ALTER TABLE menu_records ADD INDEX FKmenu_recor596691 (menu_id), ADD CONSTRAINT FKmenu_recor596691 FOREIGN KEY (menu_id) REFERENCES menus (menu_id);
ALTER TABLE orders_records ADD INDEX FKorders_rec170609 (menu_record_menu_id, menu_record_dish_id), ADD CONSTRAINT FKorders_rec170609 FOREIGN KEY (menu_record_menu_id, menu_record_dish_id) REFERENCES menu_records (menu_id, dish_id);
ALTER TABLE menu_records ADD INDEX FKmenu_recor558008 (dish_id), ADD CONSTRAINT FKmenu_recor558008 FOREIGN KEY (dish_id) REFERENCES dishes (dish_id);
ALTER TABLE ingredients ADD INDEX FKingredient247026 (dish_Id), ADD CONSTRAINT FKingredient247026 FOREIGN KEY (dish_Id) REFERENCES dishes (dish_id);
ALTER TABLE ingredients ADD INDEX FKingredient535850 (product_Id), ADD CONSTRAINT FKingredient535850 FOREIGN KEY (product_Id) REFERENCES products (product_id);
ALTER TABLE orders ADD INDEX FKorders354629 (subscription_subs_id), ADD CONSTRAINT FKorders354629 FOREIGN KEY (subscription_subs_id) REFERENCES subscriptions (subs_id);
ALTER TABLE roles_users ADD INDEX FKroles_user886729 (role_id), ADD CONSTRAINT FKroles_user886729 FOREIGN KEY (role_id) REFERENCES roles (id);
ALTER TABLE roles_users ADD INDEX FKroles_user949729 (user_id), ADD CONSTRAINT FKroles_user949729 FOREIGN KEY (user_id) REFERENCES users (id) ON UPDATE Cascade ON DELETE Cascade;
ALTER TABLE roles_buttons ADD INDEX FKroles_butt442610 (roles_role_Id), ADD CONSTRAINT FKroles_butt442610 FOREIGN KEY (roles_role_Id) REFERENCES roles (id);
ALTER TABLE roles_buttons ADD INDEX FKroles_butt17717 (menu_buttons_id), ADD CONSTRAINT FKroles_butt17717 FOREIGN KEY (menu_buttons_id) REFERENCES menu_buttons (id);
ALTER TABLE orders ADD INDEX FKorders486885 (delivery_times_delivery_id), ADD CONSTRAINT FKorders486885 FOREIGN KEY (delivery_times_delivery_id) REFERENCES delivery_times (delivery_id);
ALTER TABLE subscriptions ADD INDEX FKsubscripti816647 (user_id), ADD CONSTRAINT FKsubscripti816647 FOREIGN KEY (user_id) REFERENCES users (id);
ALTER TABLE dishes ADD INDEX FKdishes824954 (dish_type_id), ADD CONSTRAINT FKdishes824954 FOREIGN KEY (dish_type_id) REFERENCES dish_type (id);
ALTER TABLE dishes ADD INDEX FKdishes544074 (dish_category_id), ADD CONSTRAINT FKdishes544074 FOREIGN KEY (dish_category_id) REFERENCES dish_category (id);



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

INSERT INTO `products` VALUES (1, 'лимон', 0);
INSERT INTO `products` VALUES (2, 'колбаса копчёная', 0);
INSERT INTO `products` VALUES (3, 'колбаса варёная', 0);
INSERT INTO `products` VALUES (4, 'буженина', 0);
INSERT INTO `products` VALUES (5, 'маслины', 0);
INSERT INTO `products` VALUES (6, 'мясо(говядина)', 0);
INSERT INTO `products` VALUES (7, 'креветки', 0);
INSERT INTO `products` VALUES (8, 'майонез', 0);
INSERT INTO `products` VALUES (9, 'гренки', 0);
INSERT INTO `products` VALUES (10, 'листья салата', 0);
INSERT INTO `products` VALUES (11, 'помидор', 0);
INSERT INTO `products` VALUES (12, 'грибы', 0);
INSERT INTO `products` VALUES (13, 'Кук', 0);

INSERT INTO `dish_type` VALUES (1, 'Меню кафетерия');
INSERT INTO `dish_type` VALUES (2, 'Меню ресторанов');
INSERT INTO `dish_type` VALUES (3, 'Винная карта');

INSERT INTO `dish_category` VALUES (1, 'Супы', 1);
INSERT INTO `dish_category` VALUES (2, 'Горячие основные блю', 2);
INSERT INTO `dish_category` VALUES (3, 'Гарниры', 3);
INSERT INTO `dish_category` VALUES (4, 'Горячие закуски', 4);
INSERT INTO `dish_category` VALUES (5, 'Холодные закуски', 5);
INSERT INTO `dish_category` VALUES (6, 'Соусы', 6);
INSERT INTO `dish_category` VALUES (7, 'Десерты', 7);
INSERT INTO `dish_category` VALUES (8, 'Хлебобулочные издели', 8);
INSERT INTO `dish_category` VALUES (9, 'Напитки', 9);
INSERT INTO `dish_category` VALUES (10, 'Коктейли', 10);
INSERT INTO `dish_category` VALUES (11, 'Игристые вина', 10);
INSERT INTO `dish_category` VALUES (12, 'Шампанское', 10);
INSERT INTO `dish_category` VALUES (13, 'Белые вина', 10);
INSERT INTO `dish_category` VALUES (14, 'Розовые вина', 10);
INSERT INTO `dish_category` VALUES (15, 'Красные вина', 10);
INSERT INTO `dish_category` VALUES (16, 'Ликеры', 10);
INSERT INTO `dish_category` VALUES (17, 'Коньяк', 10);
INSERT INTO `dish_category` VALUES (18, 'Кальвадос', 10);
INSERT INTO `dish_category` VALUES (19, 'Бренди', 10);
INSERT INTO `dish_category` VALUES (20, 'Виски', 10);
INSERT INTO `dish_category` VALUES (21, 'Ром', 10);
INSERT INTO `dish_category` VALUES (22, 'Джин', 10);
INSERT INTO `dish_category` VALUES (23, 'Текила', 10);
INSERT INTO `dish_category` VALUES (24, 'Водка', 10);
INSERT INTO `dish_category` VALUES (25, 'Пиво', 10);
INSERT INTO `menus` (`menu_id`, `menu_date`) VALUES
(1, '2013-10-30');

INSERT INTO `dishes` VALUES (1, 'Солянка', 1, 1, null);
INSERT INTO `dishes` VALUES (2, 'Грибной суп', 2, 1, null);
INSERT INTO `dishes` VALUES (3, 'Мясной суп', 1, 1, null);
INSERT INTO `dishes` VALUES (4, 'Салат \"Цезарь\"', 1, 5, null);
INSERT INTO `dishes` VALUES (5, 'Салат \"из Кука\"', 1, 5, null);
INSERT INTO `dishes` VALUES (6, 'Толстяк', 3, 25, null);
INSERT INTO `dishes` VALUES (7, 'Bardahl', 3, 25, null);
INSERT INTO `dishes` VALUES (8, 'Blitz', 3, 25, null);
INSERT INTO `dishes` VALUES (9, 'Captain Morgan', 3, 25, null);
INSERT INTO `dishes` VALUES (10, 'Coors', 3, 25, null);
INSERT INTO `dishes` VALUES (11, 'Waggledance', 3, 25, null);
INSERT INTO `dishes` VALUES (14, 'компот из сухофрукто', 1, 9, null);
INSERT INTO `dishes` VALUES (12, 'компот яблочный', 1, 9, null);

INSERT INTO `menu_records` (`menu_id`, `dish_id`, `price`) VALUES
(1, 1, 100),
(1, 2, 150),
(1, 3, 120),
(1, 4, 200),
(1, 5, 50),
(1, 6, 80),
(1, 7, 180);

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'login');

INSERT INTO `users` (`id`, `username`, `password`, `email`, `name`, `surname`, `patronymic`, `employee_number`, `payment_type`, `discount`, `user_status`, `logins`, `last_login`, `office`, `floor`, `building`) VALUES
(1, 'administrator', '987ce3d883fe34262fffc2ccb18f480128eae9a3b17411999e6ab124328550bc', 'babur4iK@rambler.ru', 'Дмитрий', 'Бабурин', 'Владимирович', 111111, 1, NULL, 0, 16, 1382638819, '38', '1', '5б'),
(2, 'Xochenkov', 'e24c2ae5d2a72710f7a05306e24f1f13cf6feb9c4c80e7c44f47cdf4bc5be9af', 'xochenkov@rambler.ru', 'Алексей', 'Хоченков', 'Евгеньевич', 222222, 1, NULL, 0, 10, 1382546568, '7', '4', '11'),
(3, 'Umnov', 'e24c2ae5d2a72710f7a05306e24f1f13cf6feb9c4c80e7c44f47cdf4bc5be9af', 'umnov@oe-it.ru', 'Денис', 'Умнов', 'Михайлович', 343, 0, 0, 0, 3, 1382535564, '1', '2', '3'),
(5, 'galogen', '29cc30615f2e74ed6b333e127239d2c4ac4c363a6f51232422f3675bbb0f2a14', 'galogenIt@gmail.com', 'Эдуард ', 'Галиаскаров', 'Геннадьевич', 111112, 0, NULL, 0, 1, 1382639250, '33', '2', '6');

INSERT INTO `roles_users` (`role_Id`, `user_Id`) VALUES
(1, 1),
(2, 1),
(2, 2),
(2, 3),
(2, 5);

INSERT INTO `subscriptions` (`subs_id`, `user_id`, `start_date`, `end_date`, `status`) VALUES
(1, 1, '2013-10-01', '2013-10-02', 'Действител');

INSERT INTO `orders` (`order_id`, `user_id`, `delivery_times_delivery_id`, `order_date`, `delivery_date`, `delivery_point`, `order_status`, `total_price`, `subscription_subs_id`) VALUES
(2, 1, 5, '2013-10-20', '2013-10-30', 'none', 'Canceled', '999.99', NULL),
(3, 1, 7, '2013-10-20', '2013-10-30', 'none', 'Canceled', '620.00', NULL),
(4, 2, 14, '2013-10-22', '2013-10-30', 'Здание 11 ', 'Canceled', '270.00', NULL),
(5, 3, 12, '2013-10-23', '2013-10-30', 'none', 'Canceled', '530.00', NULL),
(6, 2, 1, '2013-10-23', '2013-10-30', 'none', 'NewOrder', '360.00', NULL),
(7, 3, 7, '2013-10-23', '2013-10-30', 'Здание 3 Э', 'NewOrder', '220.00', NULL),
(8, 1, 2, '2013-10-23', '2013-10-30', 'Здание 5б ', 'Canceled', '540.00', NULL),
(9, 1, 1, '2013-10-23', '2013-10-30', 'none', 'Canceled', '380.00', NULL),
(10, 1, 1, '2013-10-23', '2013-10-30', 'Здание 5б ', 'NewOrder', '250.00', NULL);

INSERT INTO `orders_records` (`order_id`, `menu_record_menu_id`, `menu_record_dish_id`, `servings_number`) VALUES
(2, 1, 1, 3),
(2, 1, 3, 5),
(2, 1, 4, 1),
(3, 1, 1, 3),
(3, 1, 3, 1),
(3, 1, 4, 1),
(4, 1, 3, 1),
(4, 1, 2, 1),
(5, 1, 2, 1),
(5, 1, 1, 1),
(5, 1, 6, 1),
(5, 1, 5, 4),
(6, 1, 7, 2),
(7, 1, 3, 1),
(7, 1, 1, 1),
(8, 1, 2, 2),
(8, 1, 3, 2),
(9, 1, 4, 1),
(9, 1, 7, 1),
(10, 1, 5, 2),
(10, 1, 2, 1);