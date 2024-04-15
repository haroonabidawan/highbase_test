<?php

namespace App\Enums;

enum AttributeTypeEnum: string
{
    case TEXT = 'text';
    case NUMBER = 'number';
    case DATE = 'date';
    case DATETIME = 'datetime';

    /**
     * @return string
     */
    public function label(): string
    {
        return match ($this) {
            self::TEXT => 'Text',
            self::NUMBER => 'Number',
            self::DATE => 'Date',
            self::DATETIME => 'Datetime',
        };
    }
}
