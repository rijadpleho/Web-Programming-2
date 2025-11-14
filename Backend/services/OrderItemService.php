<?php
require_once __DIR__ . '/../dao/OrderItemDao.php';
require_once __DIR__ . '/BaseService.php';

class OrderItemService extends BaseService {

    public function __construct() {
        $dao = new OrderItemDao();
        parent::__construct($dao);
    }
    public function getItemsForOrder($order_id) {
        return $this->dao->listByOrder($order_id);
    }
}