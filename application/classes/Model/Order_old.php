<?php defined('SYSPATH') or die('No direct script access.');
/**
* Модель таблицы order
* @author Babur
*
*/
class Model_Order extends ORM
{
        
        protected $_table_name='orders';
        
    /**
* Находит заказ по номеру возвращает его текущий статус
* @param unknown $ID номер заказ
* @return Ambigous <$this, Database_Query>
*/
        public function findOrder($ID)
        {
                $OrderStatus = DB::query(Database::SELECT, 'select order_status from Orders where order_id = :ID')
                -> param(':ID', $ID);
                return $OrderStatus;
        }
        
        /**
         * Устанавливает статус заказа
         * @param unknown $ID - номер заказа
         * @param unknown $UpdStatus - статус, который нужно установаить
         */
        public function setStatus($ID,$UpdStatus)
        {
         DB::query(Database::UPDATE, 'update Orders set order_status = :St where order_id = :ID')
                -> param(':ID', $ID)
                -> param(':St', $UpdStatus);
        }
        
}