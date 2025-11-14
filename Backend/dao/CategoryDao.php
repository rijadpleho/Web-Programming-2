<?php
require_once __DIR__ . '/BaseDao.php';

class CategoryDao extends BaseDao{
    public function __construct()
    {
        parent::__construct('category');
    }

    public function createCategory($category)
    {
        $data = [
            'name'        => $category['name'],
            'description' => $category['description'] ?? null
        ];
        return $this->insert($data);
    }

    public function getAllCategories()
    {
        return $this->getAll();
    }

    public function getCategoryById($id)
    {
        return $this->getById($id);
    }

    public function updateCategory($id, $category)
    {
        $data = [
            'name'        => $category['name'],
            'description' => $category['description'] ?? null
        ];
        return $this->update($id, $data);
    }

    public function deleteCategory($id)
    {
        return $this->delete($id);
    }
    public function getByName($name){
    $stmt = $this->connection->prepare("SELECT * FROM category WHERE name = :name");
    $stmt->bindParam(':name', $name);
    $stmt->execute();
    return $stmt->fetch();
}
}
?>