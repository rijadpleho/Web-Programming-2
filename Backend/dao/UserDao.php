<?php
require_once __DIR__ . '/BaseDao.php';

class UserDao extends BaseDao{
    public function __construct()
    {
        parent::__construct('users');
    }

    public function createUser($user)
    {
        $data = [
            'name'     => $user['name'],
            'surname'  => $user['surname'],
            'email'    => $user['email'],
            'password' => $user['password']
        ];
        return $this->insert($data);
    }

    public function getAllUsers()
    {
        return $this->getAll();
    }

    public function getUserById($id)
    {
        return $this->getById($id);
    }

    public function updateUser($id, $user)
    {
        $data = [
            'name'     => $user['name'],
            'surname'  => $user['surname'],
            'email'    => $user['email']
        ];
        return $this->update($id, $data);
    }

    public function deleteUser($id)
    {
        return $this->delete($id);
    }
}

?>
