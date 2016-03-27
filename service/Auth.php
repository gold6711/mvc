<?php
class Auth
{
    protected $sessionId;

    /**
     * Авторизация
     * $login        - логин
     * $password    - пароль
     * $remember    - нужно ли запомнить в куках
     * результат    - true или false
     */
    public function login($login, $password, $remember = true)
    {
        $model = new UserRep();
        // вытаскиваем пользователя из БД
        $user = $model->getByLoginPass($login, $password);

        if ($user == null)
            return false;

        // запоминаем имя и md5(пароль)
        if ($remember) {
            $expire = time() + 3600 * 24 * 100;
            setcookie('login', $login, $expire);
            setcookie('password', md5($password), $expire);
        }
        // открываем сессию и запоминаем SID
        $this->sid = $this->OpenSession($user->getId());
        return true;
    }

    //
    // Выход
    //
    public function logout()
    {
        setcookie('login', '', time() - 1);
        setcookie('password', '', time() - 1);
        unset($_COOKIE['login']);
        unset($_COOKIE['password']);
        unset($_SESSION['sid']);
        $this->sid = null;
        $this->uid = null;
    }

    //
    // Открытие новой сессии
    //
    public function openSession($userId)
    {
        // генерируем SID
        $sid = $this->generateStr(10);
        $now = date('Y-m-d H:i:s');
        $timeStart = $now;
        $timeLast = $now;

        $rep = new SessionsRep();
        $rep->createNew($userId, $sid, $timeStart, $timeLast);

        // регистрируем сессию в PHP сессии
        $_SESSION['sid'] = $sid;
        // возвращаем SID
        return $sid;
    }

    /**
     * Функция возвращает идентификатор текущей сессии
     */
    public function getSessionId()
    {
        if (!is_null($this->sessionId)) {
            return $this->sessionId;
        }

        // Ищем SID в сессии.
        $sid = $_SESSION['sid'];

        // Если нашли, попробуем обновить time_last в базе.
        // Заодно и проверим, есть ли сессия там.
        if (!is_null($sid != null)) {
            $rep = new SessionsRep();
            if (!$rep->updateLastTime($sid)) {
                $sid = null;
            }
        }
        $this->sessionId = $sid;
        return $this->sessionId;
    }

    private function generateStr($length = 10)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";
        $code = "";
        $clen = strlen($chars) - 1;

        while (strlen($code) < $length)
            $code .= $chars[mt_rand(0, $clen)];

        return $code;


    }
}