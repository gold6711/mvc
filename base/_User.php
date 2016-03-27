<?php
class User
{
    protected $id;
    protected $login;
    protected $pass;
    protected $email;
    protected $role_id;
    protected $role;

    /**
     * User constructor.
     * @param $login
     * @param $pass
     * @param $email
     * @param $role_id
     * @param $role
     */
    public function init($login = null, $pass = null, $email = null, $role_id= null, $role= null)
    {
        $this->login = $login;
        $this->pass = $pass;
        $this->email = $email;
        $this->role_id = $role_id;
        $this->role = $role;
    }


    public static function findIdByLoginPass($login,$pass){
        return Db::getInstance()->fetch(
            sprintf("SELECT id FROM users WHERE login = '%s' AND pass = '%s'",$login,md5($pass))
        )[0]['id'];
    }

    public static function getById($id){
        return Db::getInstance()
            ->fetchObject(
                "SELECT u.*, r.name as role FROM users u
                  LEFT JOIN role r ON r.id = u.role_id
                  WHERE u.id = {$id}",
                'User'
            );
    }
}