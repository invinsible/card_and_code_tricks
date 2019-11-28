<?php

/**
 * Базовый класс для всех моделей.
 */
abstract class BaseModel
{
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
     * Заполняет экземпляр класса ключ-значением из БД
     * @param array $arr
     */
    protected function populateModel(array $arr)
    {
        foreach ($arr as $key => $value) {
            $this->{$key} = $value;
        }
    }
}
