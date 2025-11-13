<?php
require_once __DIR__ . '/BaseDao.php';

class CartItemDao extends BaseDao{
    public function __construct()
    {
        parent::__construct('cart_items');
    }
    public function createCartItem($item)
    {
        $data = [
            'cart_id'    => $item['cart_id'],
            'product_id' => $item['product_id'],
            'quantity'   => $item['quantity']
        ];
        return $this->insert($data);
    }

    public function getAllCartItems()
    {
        return $this->getAll();
    }

    public function getCartItemById($id)
    {
        return $this->getById($id);
    }

    public function updateCartItem($id, $item)
    {
        $data = [
            'cart_id'    => $item['cart_id'],
            'product_id' => $item['product_id'],
            'quantity'   => $item['quantity']
        ];
        return $this->update($id, $data);
    }

    public function deleteCartItem($id)
    {
        return $this->delete($id);
    }

    public function listByCart($cart_id)
    {
        $stmt = $this->connection->prepare(
            "SELECT ci.*, p.name, p.price
               FROM cart_items ci
               JOIN products p ON p.id = ci.product_id
              WHERE ci.cart_id = :cart_id"
        );
        $stmt->bindParam(':cart_id', $cart_id);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function deleteCartItemsByUser($user_id) {
    $stmt = $this->connection->prepare("
        DELETE ci FROM cart_items ci
        JOIN carts c ON ci.cart_id = c.id
        WHERE c.user_id = :user_id
    ");
    $stmt->execute(['user_id' => $user_id]);
}
}
?>