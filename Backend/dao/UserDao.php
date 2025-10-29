<?php
require_once 'BaseDao.php';


class UserDao extends BaseDao {
   public function __construct() {
       parent::__construct("users");
   }


   public function getByEmail($email) {
       $stmt = $this->connection->prepare("SELECT * FROM users WHERE email = :email");
       $stmt->bindParam(':email', $email);
       $stmt->execute();
       return $stmt->fetch();
   }

   public function insertUser($name, $surname, $email, $password) {
        $stmt = $this->connection->prepare(
            "INSERT INTO users (name, surname, email, password)
             VALUES (:name, :surname, :email, :password)"
        );
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':surname', $surname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        return $this->connection->lastInsertId();
    }

    
    public function updateUser($id, $name, $surname, $email) {
        $stmt = $this->connection->prepare(
            "UPDATE users SET name = :name, surname = :surname, email = :email WHERE id = :id"
        );
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':surname', $surname);
        $stmt->bindParam(':email', $email);
        return $stmt->execute();
    }

   
    public function deleteUser($id) {
        $stmt = $this->connection->prepare("DELETE FROM users WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }



}


?>
