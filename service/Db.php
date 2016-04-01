<?php
class Db{
    protected $conn = null;
    protected $host = 'localhost';
    protected $login = 'root';
    protected $password = '';
    protected $database = 'blog_3';
    protected $charset = "utf8";

    protected static $instance = null;

    protected function __construct(){}
    protected function __clone(){}

    public static function getInstance(){
        if(is_null(self::$instance)){
            self::$instance = new static;
        }
        return self::$instance;
    }

    public function getConnection(){
        if(is_null($this->conn))
            $this->conn =  new mysqli(
                $this->host,
                $this->login,
                $this->password,
                $this->database
            );
        return $this->conn;

    }


    public function fetch($sql){
        try {
            $res = $this->query($sql);
			//echo var_dump($res);
            return $res->fetch_all(MYSQLI_ASSOC);
        } catch (Exception $e) {
            return false;
        }
    }

    public function fetchObject($sql,$class){
        $res = $this->query($sql);
        return $res->fetch_object($class);
    }

    public function query($sql){
        return $this->getConnection()->query($sql);
    }

    public function execute($sql){
        $this->getConnection()->query($sql);
        return $this->getConnection()->affected_rows;
    }

}