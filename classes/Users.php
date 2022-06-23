<?php

class Users
{
    public static function getByLogin(string $login) {

            $pdo = DB::getInstance()->getPdo();
            $res = $pdo->prepare('select first_name, middle_name, last_name  from users where `login` = ?');
            $res->execute([$login]);
            return $res->fetch(PDO::FETCH_ASSOC);
    }
}