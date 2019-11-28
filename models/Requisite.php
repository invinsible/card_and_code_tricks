<?php


/**
 * Модель реквизита
 *
 * @property int $id
 * @property string $name
 * @property int $availability
 * @property string $description
 * @property int $amount
 * @property string $photo_link
 * @property string $comment
 */
class Requisite extends BaseModel
{
    /**
     * @inheritDoc
     */
    public static function tableName(): string
    {
        return 'requisite';
    }
}