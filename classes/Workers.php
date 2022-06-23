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
        workers (
    first_name, middle_name, last_name, telegram_id) values (?, ?, ?, ?)');

        return $res->execute([
            $params['first_name'],
            $params['middle_name'],
            $params['last_name'],
            $params['telegram_id']
        ]);
    }

    public static function exist(string $telegramId) {
        $pdo = DB::getInstance()->getPdo();
        $res = $pdo->prepare('SELECT COUNT(*) FROM workers where `telegram_id` = ?');
        $res->execute([$telegramId]);
        return (bool)$res->fetchColumn();
    }
}