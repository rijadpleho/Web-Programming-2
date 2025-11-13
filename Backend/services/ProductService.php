<?php

require_once __DIR__ . '/../dao/ProductDao.php';
require_once __DIR__ . '/BaseService.php';

class ProductService extends BaseService{
    public function __construct() {
        $dao = new ProductDao();
        parent::__construct($dao);
    }

    public function createProduct($data){
        if(empty($data['name'])){
            throw new Exception ("Product price must be greater than zero");
        }
        if (empty($data['price']) || $data['price'] <= 0) {
            throw new Exception("Product price must be greater than zero.");
        }
        return $this->create($data);
    }
     /*public function getProductsByCategory($category_id) {
        return $this->dao->getByCategory($category_id);
    }

    public function getProductsWithCategory() {
        return $this->dao->getAllWithCategory();
    }*/
}
?>