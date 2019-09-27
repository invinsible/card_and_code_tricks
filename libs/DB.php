<?php

/**
 * Синглтон подключение к БД.
 */
class DB
{
    /**
     * @var PDO
     */
    public $pdo;

    private static $instance;

    /**
     * DB constructor.
     */
    private function __construct()
    {
        $dsn = 'mysql:dbname=cct_db;host=127.0.0.1';
        $user = 'root';
        $password = '';

        try {
            $db = new PDO($dsn, $user, $password);
        } catch (PDOException $e) {
            die('Подключение не удалось: ' . $e->getMessage());
        }

        $this->pdo = $db;
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }

    /**
     * @return DB
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            $instance = new DB();

            self::$instance = $instance;
        }

        return self::$instance;
    }
}
