<?php

namespace App\Enums;

enum BooleanEnum: int
{
    case TRUE = 1;
    case FALSE = 0;

    /**
     * @return string
     */
    public function label(): string
    {
        return match ($this) {
            self::TRUE => 'True',
            self::FALSE => 'False',
        };
    }
}
