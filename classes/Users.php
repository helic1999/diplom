<?php

class Users
{
    public static function getByLogin(string $login): array
    {
        $pdo = DB::getInstance()->getPdo();
        $res = $pdo->prepare('select id, first_name, middle_name, last_name, role_id  from users where `login` = ?');
        $res->execute([$login]);
        return $res->fetch(PDO::FETCH_ASSOC);
    }

    public static function isAdmin(string $login): bool
    {
        $user = static::getByLogin($login);
        return $user['role_id'] == 1;
    }
}