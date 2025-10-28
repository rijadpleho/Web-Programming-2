<?php
require_once 'BaseDao.php';
class CartItemDao extends BaseDao{
    public function __construct(){
        parent::__construct("cart_items");
    }
    public function listByCart($cart_id){
        $sql = "SELECT ci.*, p.name, p.price
                FROM cart_items ci
                JOIN products p ON p.id = ci.product_id
                WHERE ci.cart_id = :cart_id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':cart_id', $cart_id);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
?>