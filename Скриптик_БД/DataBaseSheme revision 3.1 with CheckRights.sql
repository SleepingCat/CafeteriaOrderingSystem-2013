CREATE TABLE users (id int(10) NOT NULL AUTO_INCREMENT, username varchar(20) NOT NULL UNIQUE, password varchar(255) NOT NULL, email varchar(50) NOT NULL UNIQUE, name varchar(255) NOT NULL, employee_number int(10), payment_type tinyint DEFAULT 0 NOT NULL, discount int(2), user_status tinyint, logins int(10) DEFAULT 0 NOT NULL, last_login int(10) DEFAULT Null, surname varchar(20), patronymic varchar(255), floor varchar(11) NOT NULL, office varchar(20) NOT NULL, building varchar(20) NOT NULL, PRIMARY KEY (id));
CREATE TABLE orders (order_id int(10) NOT NULL AUTO_INCREMENT, user_id int(10) NOT NULL, delivery_times_delivery_id int(10) NOT NULL, order_date date NOT NULL, delivery_date date NOT NULL, delivery_point varchar(255) NOT NULL, order_status varchar(20) DEFAULT 'Not Staffed' NOT NULL, total_price numeric(5, 2), subscription_subs_id int(10), PRIMARY KEY (order_id));
CREATE TABLE orders_records (order_id int(10) NOT NULL, menu_record_menu_id int(5) NOT NULL, menu_record_dish_id int(10) NOT NULL, menu_record_portion_type_id int(10) NOT NULL, servings_number int(3) NOT NULL, PRIMARY KEY (order_id, menu_record_menu_id, menu_record_dish_id, menu_record_portion_type_id));
CREATE TABLE menus (menu_id int(5) NOT NULL AUTO_INCREMENT, menu_date date NOT NULL UNIQUE, PRIMARY KEY (menu_id));
CREATE TABLE menu_records (menu_id int(5) NOT NULL, dish_id int(10) NOT NULL, portion_type_id int(10) NOT NULL, price double NOT NULL, PRIMARY KEY (menu_id, dish_id, portion_type_id));
CREATE TABLE dishes (dish_id int(10) NOT NULL AUTO_INCREMENT, dish_name varchar(60) NOT NULL, dish_type_id int(10) NOT NULL, dish_category_id int(11) NOT NULL, is_standart tinyint, PRIMARY KEY (dish_id));
CREATE TABLE ingredients (dish_Id int(10) NOT NULL, product_Id int(10) NOT NULL, yield double NOT NULL, PRIMARY KEY (dish_Id, product_Id));
CREATE TABLE products (product_id int(10) NOT NULL AUTO_INCREMENT, product_name varchar(20) NOT NULL, balance double NOT NULL, PRIMARY KEY (product_id));
CREATE TABLE subscriptions (subs_id int(10) NOT NULL AUTO_INCREMENT, user_id int(10) NOT NULL, start_date date NOT NULL, end_date date, status varchar(10), PRIMARY KEY (subs_id));
CREATE TABLE roles (id int(10) NOT NULL AUTO_INCREMENT, name varchar(20) NOT NULL UNIQUE, PRIMARY KEY (id));
CREATE TABLE roles_users (role_id int(10) NOT NULL, user_id int(10) NOT NULL);
CREATE TABLE menu_buttons (id int(11) NOT NULL AUTO_INCREMENT, name varchar(150) NOT NULL, name_link varchar(50) NOT NULL, PRIMARY KEY (id));
CREATE TABLE roles_buttons (roles_role_Id int(10) NOT NULL, menu_buttons_id int(11) NOT NULL, PRIMARY KEY (roles_role_Id, menu_buttons_id));
CREATE TABLE delivery_times (delivery_id int(10) NOT NULL AUTO_INCREMENT, delivery_time time NOT NULL, delivery_limit int(11) NOT NULL, PRIMARY KEY (delivery_id));
CREATE TABLE dish_type (id int(10) NOT NULL AUTO_INCREMENT, name varchar(20) NOT NULL, PRIMARY KEY (id));
CREATE TABLE dish_category (id int(11) NOT NULL AUTO_INCREMENT, name varchar(20) NOT NULL, priority int(10) NOT NULL, PRIMARY KEY (id));
CREATE TABLE portion_type (id int(10) NOT NULL AUTO_INCREMENT, type_name varchar(10) NOT NULL, weight float NOT NULL, dimension varchar(20) NOT NULL, PRIMARY KEY (id));
CREATE TABLE actions (id int(10) NOT NULL AUTO_INCREMENT, nameAction varchar(50) NOT NULL, nameControl varchar(50) NOT NULL, PRIMARY KEY (id));
CREATE TABLE rights (roles_id int(10) NOT NULL, actions_id int(10) NOT NULL);
ALTER TABLE orders_records ADD INDEX FKorders_rec398980 (order_id), ADD CONSTRAINT FKorders_rec398980 FOREIGN KEY (order_id) REFERENCES orders (order_id);
ALTER TABLE orders ADD INDEX FKorders322301 (user_id), ADD CONSTRAINT FKorders322301 FOREIGN KEY (user_id) REFERENCES users (id);
ALTER TABLE menu_records ADD INDEX FKmenu_recor596691 (menu_id), ADD CONSTRAINT FKmenu_recor596691 FOREIGN KEY (menu_id) REFERENCES menus (menu_id);
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
ALTER TABLE menu_records ADD INDEX FKmenu_recor698485 (portion_type_id), ADD CONSTRAINT FKmenu_recor698485 FOREIGN KEY (portion_type_id) REFERENCES portion_type (id);
ALTER TABLE orders_records ADD INDEX FKorders_rec644380 (menu_record_menu_id, menu_record_dish_id, menu_record_portion_type_id), ADD CONSTRAINT FKorders_rec644380 FOREIGN KEY (menu_record_menu_id, menu_record_dish_id, menu_record_portion_type_id) REFERENCES menu_records (menu_id, dish_id, portion_type_id);
ALTER TABLE rights ADD INDEX FKrights84148 (roles_id), ADD CONSTRAINT FKrights84148 FOREIGN KEY (roles_id) REFERENCES roles (id);
ALTER TABLE rights ADD INDEX FKrights123236 (actions_id), ADD CONSTRAINT FKrights123236 FOREIGN KEY (actions_id) REFERENCES actions (id);
