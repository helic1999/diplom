<?php

class DB
{
    protected static ?DB $instance = null;

    protected  ?PDO $pdo = null;

    private function __construct()
    {
        $params = require(__DIR__. '/../config/db.php');
        $this->pdo = new PDO($params['driver'] . ':dbname=' . $params['dbname'] . ';host=' . $params['host'],
            $params['user'],
            $params['pass']);
    }


    public static function getInstance(): ?DB
    {
        if (!isset($instance)) {
            static::$instance = new DB();
        }
        return self::$instance;
    }

    public function getPdo() {
        return $this->pdo;
    }
}