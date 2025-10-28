<?php
require_once 'BaseDao.php';
class ProductDao extends BaseDao{
    public function __construct(){
        parent::__construct("products");
    }
    public function listWithCategory(){
      $sql = "SELECT p.*, c.name AS category_name 
                FROM products p
                JOIN category c ON p.category_id = c.id
                ORDER BY p.id DESC";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();  
    }
    public function listByCategoryId($category_id){
        $stmt = $this->connection->prepare("SELECT * FROM products WHERE category_id = :category_id");
        $stmt->bindParam(':category_id', $category_id);
        $stmt->execute();
        return $stmt->fetchAll();

    }
}
?>