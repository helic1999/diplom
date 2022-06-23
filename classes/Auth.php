<?php
require_once('DB.php');

class Auth
{

    protected static function generateCode(int $length = 6)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
        $code = "";
        $clen = strlen($chars) - 1;
        while (strlen($code) < $length) {
            $code .= $chars[mt_rand(0, $clen)];
        }
        return $code;
    }


    public static function login()
    {
        if (!isset($_POST['login']) || !isset($_POST['password'])) {
            return false;
        }
        if (!isset($_SESSION)) {
            session_start();
        }
        $pdo = DB::getInstance()->getPdo();
        $query = $pdo->prepare("SELECT `login`, `password` from users where `login` = ? ");
        $query->execute([$_POST['login']]);
        $params = $query->fetch(PDO::FETCH_ASSOC);

        if (empty($params)) {
            return false;
        }

        if ($params['login'] == $_POST['login'] && $params['password'] == md5($_POST['password'])) {
            $_SESSION['admin'] = $params;
            return true;
        }

        return false;
    }


    public static function isLogged(): bool
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (!isset($_SESSION['admin']['login']) || !isset($_SESSION['admin']['password'])) {
            return false;
        }

        $pdo = DB::getInstance()->getPdo();
        $query = $pdo->prepare("SELECT `login`, `password` from  users where `login` = ? ");
        $query->execute([$_SESSION['admin']['login']]);
        $params = $query->fetch(PDO::FETCH_ASSOC);
        if ($params['login'] == $_SESSION['admin']['login']
            && $params['password'] == $_SESSION['admin']['password']
        ) {
            return true;
        }

        return false;
    }

    public static function logout(): void
    {
        if (!isset($_SESSION)) {
            session_start();
        }


        unset($_SESSION['admin']);
    }

    public static function redirectUnauthorised(): void
    {
        if (!static::isLogged()) {
            header('Location: /login.php');
            exit;
        }
    }

}