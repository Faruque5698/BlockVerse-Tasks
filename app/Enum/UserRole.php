<?php

namespace App\Enum;

enum UserRole: string
{
    case ADMIN = 'admin';
    case EDITOR = 'editor';
    case AUTHOR = 'author';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
