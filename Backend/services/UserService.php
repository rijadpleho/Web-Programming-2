<?php

require_once __DIR__. '/../dao/UserDao.php';
require_once __DIR__ . '/BaseService.php';

class UserService extends BaseService{
    public function __construct(){
        $dao=new UserDao();
        parent::__construct($dao);
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
}






