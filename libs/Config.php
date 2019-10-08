<?php
/**
 * Синглтон для передачи свойств конфигурации
 * @method static Config getInstance()
 */
class Config
{
    use SingletonTrait;

    public $dsn;
    public $db_user;
    public $db_password;
    public $routes = [];

    public function load(array $arr)
    {
        foreach ($arr as $key => $value) {
            $this->{$key} = $value;
        }
    }

}