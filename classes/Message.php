<?php
require_once('DB.php');

class Message
{
    public static function save($from, $text)
    {
        $pdo = DB::getInstance()->getPdo();
        $res = $pdo->prepare('INSERT INTO
        messages (
    `text`, `author`) values (?, ?)');

        $res->execute([
            $text,
            $from

        ]);

        return $pdo->lastInsertId();
    }

    public static function savePivot($messageId, $workerId): void
    {
        $pdo = DB::getInstance()->getPdo();
        $res = $pdo->prepare('INSERT INTO
        worker_message (
    `message_id`, `worker_id`) values (?, ?)');

        $res->execute([
            $messageId,
            $workerId
        ]);
    }
}