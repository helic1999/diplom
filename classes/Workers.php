<?php
require_once('DB.php');
class Workers
{
    public static function getAll(): array
    {
        $pdo = DB::getInstance()->getPdo();
        $res = $pdo->query('select first_name, middle_name, last_name, telegram_id from workers');
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create(array $params) {
        $pdo = DB::getInstance()->getPdo();
        $res = $pdo->prepare('INSERT INTO
        users (
    first_name, middle_name, last_name, login, password, role_id) values (?, ?, ?, ?, ?, 2)');

        return $res->execute([
            $params['first_name'],
            $params['middle_name'],
            $params['last_name'],
            $params['login'],
            md5($params['password'])
        ]);
    }
}