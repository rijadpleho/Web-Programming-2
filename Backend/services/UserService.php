<?php

require_once __DIR__. '/../dao/UserDao.php';
require_once __DIR__ . '/../dao/OrderDao.php';
require_once __DIR__ . '/../dao/OrderItemDao.php';
require_once __DIR__ . '/../dao/CartDao.php';
require_once __DIR__ . '/../dao/CartItemDao.php';
require_once __DIR__ . '/BaseService.php';

class UserService extends BaseService{
    private $orderDao;
    private $orderItemDao;
    private $cartDao;
    private $cartItemDao;

    public function __construct(){
        $dao=new UserDao();
        parent::__construct($dao);
        $this->orderDao     = new OrderDao();
        $this->orderItemDao = new OrderItemDao();
        $this->cartDao      = new CartDao();
        $this->cartItemDao  = new CartItemDao();
    }
    public function registerUser($data){

    if(empty($data['email'])){
        throw new Exception ("Email required");
    }
    if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
        throw new Exception("Enter a vaild email address");
    }
    if(empty($data['password'])){
        throw new Exception("Password required");
    }
    if(strlen($data['password'])<6){
        throw new Exception("Password must be 6 characters long");
    }
    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
    return $this->create($data);
}
  public function getByEmail($email) {
        return $this->dao->getByEmail($email);
    }
    public function deleteUserCompletely($user_id) {

    $this->orderItemDao->deleteOrderItemsByUser($user_id);

    $this->orderDao->deleteOrdersByUser($user_id);

    $this->cartItemDao->deleteCartItemsByUser($user_id);

    $this->cartDao->deleteCartsByUser($user_id);

    return $this->dao->delete($user_id);
}
}






