<?php
require_once(__DIR__ . '/DB.php');
class Foreman
{
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