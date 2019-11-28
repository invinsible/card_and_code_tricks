<?php

trait SingletonTrait
{
    /**
     * @var instance
     */
    private static $instance;

    private function __construct()
    {
        $this->init();
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }

    /**
     * @return mixed
     */
    public static function getInstance()
    {
        if (static::$instance === null) {
            $instance = new static();

            static::$instance = $instance;
        }

        return static::$instance;
    }

    /**
     * Вызывается в конструкторе экземпляра класса
     */
    protected function init()
    {
    }
}