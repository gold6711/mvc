<?php
class User
{
    protected $id;
    protected $login;
    protected $pass;
    protected $email;
    protected $role_id;
    protected $role;
    protected $sessionId;

    public function getId(){
        return $this->id;
    }

    public function getCurrent(){
        $rep = new UserRep();
        $userId = $this->getUserId();

        if($userId)
            return $rep->getById($userId);
        else{
            // Нет сессии? Ищем логин и md5(пароль) в куках.
            // Т.е. пробуем переподключиться.
            if (isset($_COOKIE['login'])){
                $user = $rep->getByLoginPass($_COOKIE['login'],$_COOKIE['password']);
                if (!is_null($user)){
                    $auth = new Auth();
                    $auth->OpenSession($user->getId());
                    return $user;
                }
            }
        }
        return null;
    }

    /*******************************************************************/
    /*******************************************************************/
    public function getUserId(){
        if(!is_null($this->id))
            return $this->id;

        $auth = new Auth();
        $sessionId = $auth->getSessionId();

        if(is_null($sessionId))
            return null;
        $rep = new SessionsRep();
        return $rep->getUidBySid($sessionId);
    }
}