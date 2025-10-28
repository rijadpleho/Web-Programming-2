<?php
require_once 'BaseDao.php';
class CartDao extends BaseDao{
    public function __construct(){
        parent::__construct("carts");
    }
    public function getActiveByUser($user_id){
        $stmt = $this->connection->prepare(
            "SELECT * FROM carts WHERE user_id = :user_id AND status = 'active' ORDER BY id DESC LIMIT 1"
        );
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return $stmt->fetch();
    }
}
?>
