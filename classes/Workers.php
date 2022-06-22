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
}