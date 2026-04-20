<?php

namespace App\Enums;

enum AccessLevel: string
{
    case PUBLIC = 'public';
    case INTERNAL = 'internal';
    case RESTRICTED = 'restricted';

    public function label(): string
    {
        return match($this) {
            self::PUBLIC => 'Publik (Bebas)',
            self::INTERNAL => 'Tingkat Internal (Wajib Login)',
            self::RESTRICTED => 'Rahasia / Terbatas',
        };
    }
}
