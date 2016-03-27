<?php
class _Auth
{
    public static  function checkUser(){
        session_start();
        if(isset($_SESSION['user'])){
            return User::getById($_SESSION['user']);
        }else{
            header("Location: auth.php");
            exit;
        }
    }

    public static function rememberUser($id){
        if (!session_id()) {
            session_start();
        }
        $_SESSION['user'] = $id;
    }
}