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

public function insertProduct($name, $price, $category_id) {
        $stmt = $this->connection->prepare(
            "INSERT INTO products (name, price, category_id)
             VALUES (:name, :price, :category_id)"
        );
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->execute();
        return $this->connection->lastInsertId();
    }

    
    public function updateProduct($id, $name, $price) {
        $stmt = $this->connection->prepare(
            "UPDATE products SET name = :name, price = :price WHERE id = :id"
        );
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':price', $price);
        return $stmt->execute();
    }

   
    public function deleteProduct($id) {
        $stmt = $this->connection->prepare("DELETE FROM products WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

}
?>