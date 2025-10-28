<?php
require_once 'BaseDao.php';
class OrderItemDao extends BaseDao{
    public function __construct(){
        parent::__construct("order_items");
    }
    public function listByOrder($order_id){
        $sql = "SELECT oi.*, p.name, p.price
                FROM order_items oi
                JOIN products p ON p.id = oi.product_id
                WHERE oi.order_id = :order_id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':order_id', $order_id);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
?>