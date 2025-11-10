<?php
require_once __DIR__ . '/BaseDao.php';

class ProductDao extends BaseDao{
    public function __construct()
    {
        parent::__construct('products');
    }

    public function createProduct($product)
    {
        $data = [
            'name'        => $product['name'],
            'price'       => $product['price'],
            'category_id' => $product['category_id']
        ];
        return $this->insert($data);
    }

    public function getAllProducts()
    {
        return $this->getAll();
    }

    public function getProductById($id)
    {
        return $this->getById($id);
    }

    public function updateProduct($id, $product)
    {
        $data = [
            'name'        => $product['name'],
            'price'       => $product['price'],
            'category_id' => $product['category_id']
        ];
        return $this->update($id, $data);
    }

    public function deleteProduct($id)
    {
        return $this->delete($id);
    }
    public function getByCategory($category_id){
    $stmt = $this->connection->prepare("SELECT * FROM products WHERE category_id = :category_id");
    $stmt->bindParam(':category_id', $category_id);
    $stmt->execute();
    return $stmt->fetchAll();
}

public function getAllWithCategory(){
    $sql = "SELECT p.*, c.name AS category_name
              FROM products p
              JOIN category c ON p.category_id = c.id";
    $stmt = $this->connection->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}
}
?>