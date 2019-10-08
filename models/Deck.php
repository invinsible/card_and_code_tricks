<?php

/**
 * Модель колоды
 *
 * @property int $id
 * @property string $name
 * @property int $availability
 * @property string $color
 * @property string $description
 * @property int $amount
 * @property string $photo_link
 * @property string $comment
 */
class Deck/* extends BaseModel*/
{
    /**
     * Находит в БД запись по указанному айди и возвращает её модель.
     * @param int $id
     * @return Deck|null
     */
    public static function findOne(int $id): ?Deck
    {
        $db = DB::getInstance()->pdo;

        $stmt = $db->prepare('SELECT * FROM decks WHERE id = :id');

        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetch();

        
        if ($result === false) {
            return null;
        }


        $model = new Deck();
        foreach ($result as $name => $value) {
            $model->{$name} = $value;
        }

        return $model;
    }

    /**
        * Находит все записи в БД
        * @return array|null
    */
    public static function findAll(): ?array
    {
        $db = DB::getInstance()->pdo;

        $stmt = $db->prepare('SELECT * FROM decks');
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();
        
        if ($result === false) {
            return null;
        }
        
        return $result;
    }
}
