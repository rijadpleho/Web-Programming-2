<?php

require_once __DIR__ . '/../dao/CartDao.php';
require_once __DIR__ . '/BaseService.php';

class CartService extends BaseService{
     public function __construct() {
        $dao = new CartDao();
        parent::__construct($dao);
    }
    public function getOrCreateCart($user_id){
        $active=$this->dao->getActiveByUser($user_id);
        if($active){
            return $active;
        }
        $this->create([
            'user_id'=>$user_id, 'status' =>'active'
        ]);
        return $this->dao->getActiveByUser($user_id);
    }
}
?>