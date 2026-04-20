<?php

namespace App\Enums;

enum RelationType: string
{
    case AMEND = 'amend'; // Mengubah
    case REVOKE = 'revoke'; // Mencabut
    case BASE = 'base'; // Dasar hukum
    case IMPLEMENTATION = 'implementation'; // Pelaksanaan

    public function label(): string
    {
        return match($this) {
            self::AMEND => 'Mengubah',
            self::REVOKE => 'Mencabut',
            self::BASE => 'Dasar Hukum',
            self::IMPLEMENTATION => 'Peraturan Pelaksana',
        };
    }
}
