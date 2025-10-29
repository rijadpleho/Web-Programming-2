<?php
require_once 'BaseDao.php';
class CategoryDao extends BaseDao{
    public function __construct(){
        parent::__construct("category");
    }
    public function getByName($name){
        $stmt = $this->connection->prepare("SELECT * FROM category WHERE name = :name");
        $stmt->bindParam(':name', $name);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function updateCategory($id, $newName, $newDescription) {
        $stmt = $this->connection->prepare(
            "UPDATE category SET name = :name, description = :description WHERE id = :id"
        );
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $newName);
        $stmt->bindParam(':description', $newDescription);
        return $stmt->execute();
    }

    
    public function deleteCategory($id) {
        $stmt = $this->connection->prepare("DELETE FROM category WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>