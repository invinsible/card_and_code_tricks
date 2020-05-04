<?php

/**
 * Модель фокуса
 *
 * @property int $id
 * @property string $name
 * @property string $difficult
 * @property int $preparation
 * @property string $steps
 * @property string $video_link
 * @property string $video_author
 * @property int $views
 * @property string $reaction
 * @property string $comment
 */
class Trick extends BaseModel
{
    /**
     * @inheritDoc
     */
    public static function tableName(): string
    {
        return 'tricks';
    }

    public function validate(): bool
    {
        if ($this->name === '') {
            return false;
        }       

        return true;
    }
}
