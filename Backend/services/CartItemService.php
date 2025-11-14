<?php
require_once __DIR__ . '/../dao/CartItemDao.php';
require_once __DIR__ . '/BaseService.php';

class CartItemService extends BaseService {

    public function __construct() {
        $dao = new CartItemDao();
        parent::__construct($dao);
    }
    public function addItemToCart($data){
        if(empty($data['cart_id'])|| empty($data['product_id'])){
            throw new Exception("Cart ID and Product ID are required");
        }
        if(empty($data['quantity'])|| $data['quantity']<1){
            throw new Exception("Quantity must be at least 1");
        }
        return $this->create($data);
    }
    public function getItemsForCart($cart_id){
        return $this->dao->listByCart($cart_id);
    }
}
?>