<?php
require_once __DIR__ . '/BaseDao.php';

class CartDao extends BaseDao{
    public function __construct()
    {
        parent::__construct('carts');
    }

    public function createCart($cart)
    {
        $data = [
            'user_id' => $cart['user_id'],
            'status'  => $cart['status'] 
        ];
        return $this->insert($data);
    }

    public function getAllCarts()
    {
        return $this->getAll();
    }

    public function getCartById($id)
    {
        return $this->getById($id);
    }

    public function updateCart($id, $cart)
    {
        $data = [
            'user_id' => $cart['user_id'],
            'status'  => $cart['status']
        ];
        return $this->update($id, $data);
    }

    public function deleteCart($id)
    {
        return $this->delete($id);
    }
    public function getActiveByUser($user_id)
    {
        $stmt = $this->connection->prepare(
            "SELECT * FROM carts WHERE user_id = :user_id AND status = 'active' ORDER BY id DESC LIMIT 1"
        );
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return $stmt->fetch();
    }
    public function deleteCartsByUser($user_id) {
    $stmt = $this->connection->prepare("
        DELETE FROM carts WHERE user_id = :user_id
    ");
    $stmt->execute(['user_id' => $user_id]);
}
public function deleteCartItemsByCartId($cart_id) {
    $stmt = $this->connection->prepare("
        DELETE FROM cart_items WHERE cart_id = :cart_id
    ");
    $stmt->execute(['cart_id' => $cart_id]);
}
}
?>
