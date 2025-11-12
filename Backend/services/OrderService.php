<?php
require_once __DIR__ . '/../dao/OrderDao.php';
require_once __DIR__ . '/../dao/CartItemDao.php';
require_once __DIR__ . '/../dao/OrderItemDao.php';
require_once __DIR__ . '/BaseService.php';

class OrderService extends BaseService {

    private $cartItemDao;
    private $orderItemDao;

    public function __construct() {
        $dao = new OrderDao();
        parent::__construct($dao);
        $this->cartItemDao = new CartItemDao();
        $this->orderItemDao = new OrderItemDao();
    }
    public function createOrderFromCart($user_id, $cart_id) {
        $items = $this->cartItemDao->listByCart($cart_id);

        if (empty($items)) {
            throw new Exception("Cart is empty.");
        }
        $total = 0;
        foreach ($items as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $orderData = [
            'user_id' => $user_id,
            'status'  => 'pending',
            'total'   => $total
        ];

        return $this->create($orderData);
    }
     public function getOrdersForUser($user_id) {
        return $this->dao->getByUserId($user_id);
    }
    public function deleteOrderWithItems($id) {
       
       $this->orderItemDao->deleteByOrderId($id);
        return $this->dao->delete($id);
    }
}
?>