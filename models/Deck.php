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
class Deck extends BaseModel
{
    /**
     * @inheritDoc
     */
    public static function tableName(): string
    {
        return 'decks';
    }
}
