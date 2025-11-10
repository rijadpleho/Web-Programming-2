<?php
require_once __DIR__ . '/../dao/CategoryDao.php';
require_once __DIR__ . '/BaseService.php';

class CategoryService extends BaseService {

    public function __construct() {
        $dao = new CategoryDao();
        parent::__construct($dao);
    }

    public function createCategory($data){
        if (empty($data['name'])) {
            throw new Exception("Category name required");
        }
        return $this->create($data);
    }
    public function getByName($name){
        return $this->dao->getByName($name);
    }
}
?>