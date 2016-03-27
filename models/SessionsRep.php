<?php


class SessionsRep
{
    /** @var Db */
    private $conn = null;

    public function __construct()
    {
        $this->conn = Db::getInstance();
    }

    /*
    * Очистка неиспользуемых сессий
    */
    public function clearSessions()
    {
        return Db::getInstance()->execute(
            sprintf("DELETE FROM sessions WHERE time_last < %s",date('Y-m-d H:i:s', time() - 60 * 20))
        );
    }

    public function createNew($userId,$sid,$timeStart,$timeLast){
        return DB::getInstance()->execute(
            sprintf(
                "INSERT INTO sessions(user_id, sid, time_start, time_last) VALUES (%s,'%s','%s','%s')",
                $userId, $sid, $timeStart, $timeLast
            )
        );
    }

    public function updateLastTime($sid,$time = null){
        if(is_null($time)){
            $time = date('Y-m-d H:i:s');
        }

        return Db::getInstance()->execute(
            sprintf("UPDATE sessions SET time_last = %s WHERE sid = %s",$time , $sid)
        );
    }

    public  function getUidBySid($sid){
        return DB::getInstance()->fetch(
            sprintf("SELECT user_id FROM sessions WHERE sid = '%s'",$sid)
        )[0]['user_id'];
    }	
}



