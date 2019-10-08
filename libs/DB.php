<?php

/**
 * Синглтон подключение к БД.
 * @method static DB getInstance()
 */
class DB
{
    use SingletonTrait;

    /**
     * @var PDO
     */
    public $pdo;

    protected function init() {
        $myConfig = Config::getInstance();

        try {
            $db = new PDO($myConfig->dsn, $myConfig->db_user, $myConfig->db_password);
        } catch (PDOException $e) {
            die('Подключение не удалось: ' . $e->getMessage());
        }

        $this->pdo = $db;
    }

}
