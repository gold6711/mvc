<?php
class UserRep
{
    /** @var Db */
    private $conn = null;

    public function __construct()
    {
        $this->conn = Db::getInstance();
    }

    /**
     * @return User
     */
    public function getByLoginPass($login,$pass)
    {
        return $this->conn->fetchObject(
            sprintf(
                "SELECT u.*, r.name as role FROM users u
                  LEFT JOIN role r ON r.id = u.role_id
                  WHERE login = '%s' AND pass = '%s'",$login,md5($pass)
            ),'User'
        );
    }

    /**
     * @return User
     */
    public function getById($id){
        return $this->conn->fetchObject(
                "SELECT u.*, r.name as role FROM users u
                  LEFT JOIN role r ON r.id = u.role_id
                  WHERE u.id = {$id}",
                'User'
            );
    }
}