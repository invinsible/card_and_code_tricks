<?php

/**
 * Базовый класс для всех моделей.
 */
abstract class BaseModel
{
    /**
     * Флаг существования записи в БД
     * @var
     */
    public $isPopulated = false;

    /**
     * Массив для хранения заполненных аттрибутов модели
     * @var array
     */
    protected $oldAttributes = [];

    /**
     * Массив, хранящий динамические свойства модели.
     * @var array
     */
    protected $attributes = [];

    /**
     * Метод возвращает название таблицы
     * @return string
     */
    public static abstract function tableName(): string;

    /**
     * Находит в БД запись по указанному айди и возвращает её модель.
     * @param int $id
     * @return BaseModel|null
     */
    public static function findOne(int $id): ?BaseModel
    {
        $tableName = static::tableName();

        $db = DB::getInstance()->pdo;

        $stmt = $db->prepare("SELECT * FROM {$tableName} WHERE id = :id");

        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetch();


        if ($result === false) {
            return null;
        }


        $model = new static();
        $model->populateModel($result);

        return $model;
    }

    /**
     * Находит все записи в БД
     * @return array
     */
    public static function findAll(): array
    {
        $tableName = static::tableName();

        $db = DB::getInstance()->pdo;

        $stmt = $db->prepare("SELECT * FROM {$tableName}");
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();

        $arrayModels = [];

        foreach ($result as $row) {
            $model = new static();
            $model->populateModel($row);

            $arrayModels[] = $model;
        }

        return $arrayModels;
    }

    /**
     * Создаёт или обновляет запись в БД.
     * @return bool
     */
    public function save(): bool
    {
        if ($this->isPopulated) {
            return $this->update();
        } else {
            return $this->insert();
        }
    }

    /**
     * Создает новую запись
     * @return bool
     */
    protected function insert(): bool
    {

        $tableName = static::tableName();

        $db = DB::getInstance()->pdo;

        $columns = array_keys($this->attributes);
        $values = array_values($this->attributes);

        $columnsString = '`' . implode('`,`', $columns) . '`';
        $placeholdersString = implode(',', array_fill(0, count($columns), '?'));

        $query = "INSERT INTO {$tableName} ({$columnsString}) VALUES ({$placeholdersString})";
        $stmt = $db->prepare($query);

        foreach ($values as $key => $value) {
            $stmt->bindValue($key + 1, $value);
        }

        if ($stmt->execute()) {
            return true;
        }

        $message = $stmt->errorInfo()[2];
        die("SQL Error: '{$message}'.");
    }

    protected function update(): bool
    {
        /**
         * Массивы изменений
         */
        $difference = [];
        $differenceKey = [];

        $tableName = static::tableName();

        $db = DB::getInstance()->pdo;

        foreach ($this->attributes as $key => $value) {
            if ($this->oldAttributes[$key] !== $value) {
                $differenceKey[] = $key;
                $difference[] = $key . '=' . '?';
            }
        }

        $columnString = implode(',', $difference);
        $query = "UPDATE {$tableName} SET {$columnString} WHERE id=?";
        $stmt = $db->prepare($query);

        foreach ($differenceKey as $key => $value) {
            $stmt->bindValue($key + 1, $this->attributes[$value]);
        }
        $stmt->bindValue(count($differenceKey) + 1, $this->id);

        if ($stmt->execute()) {
            return true;
        }

        $message = $stmt->errorInfo()[2];
        die("SQL Error: '{$message}'.");


    }

    /**
     * Удаление записи
     * @return bool
     */
    public function delete(): bool
    {
        $tableName = static::tableName();

        $db = DB::getInstance()->pdo;

        $stmt = $db->prepare("DELETE FROM {$tableName} WHERE id=?");
        $stmt->bindValue(1, $this->id);

        if ($stmt->execute()) {
            return true;
        }

        $message = $stmt->errorInfo()[2];
        die("SQL Error: '{$message}'.");
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function __get(string $name)
    {
        return $this->attributes[$name];
    }

    /**
     * @param string $name
     * @param $value
     */
    public function __set(string $name, $value)
    {
        $this->attributes[$name] = $value;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function __isset(string $name)
    {
        return array_key_exists($name, $this->attributes);
    }

    /**
     * Заполняет экземпляр класса ключ-значением из БД
     * @param array $arr
     */
    protected function populateModel(array $arr)
    {
        foreach ($arr as $key => $value) {
            $this->{$key} = $value;
            $this->oldAttributes[$key] = $value;
        }

        $this->isPopulated = true;
    }
}
