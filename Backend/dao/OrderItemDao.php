<?php
require_once __DIR__ . '/BaseDao.php';

class OrderItemDao extends BaseDao{
    public function __construct()
    {
        parent::__construct('order_items');
    }

    public function createOrderItem($item)
    {
        $data = [
            'order_id'   => $item['order_id'],
            'product_id' => $item['product_id'],
            'quantity'   => $item['quantity']
        ];
        return $this->insert($data);
    }

    public function getAllOrderItems()
    {
        return $this->getAll();
    }

    public function getOrderItemById($id)
    {
        return $this->getById($id);
    }
    public function updateOrderItem($id, $item)
    {
        $data = [
            'order_id'   => $item['order_id'],
            'product_id' => $item['product_id'],
            'quantity'   => $item['quantity']
        ];
        return $this->update($id, $data);
    }
    public function deleteOrderItem($id)
    {
        return $this->delete($id);
    }
    public function listByOrder($order_id)
    {
        $stmt = $this->connection->prepare(
            "SELECT oi.*, p.name, p.price
               FROM order_items oi
               JOIN products p ON p.id = oi.product_id
              WHERE oi.order_id = :order_id"
        );
        $stmt->bindParam(':order_id', $order_id);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
?>