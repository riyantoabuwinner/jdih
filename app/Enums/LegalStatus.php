<?php

namespace App\Enums;

enum LegalStatus: string
{
    case ACTIVE = 'active'; // Berlaku
    case INACTIVE = 'inactive'; // Tidak Berlaku
    case REVOKED = 'revoked'; // Dicabut
    case AMENDED = 'amended'; // Diubah
    case DRAFT = 'draft'; // Dalam Proses

    public function label(): string
    {
        return match($this) {
            self::ACTIVE => 'Berlaku',
            self::INACTIVE => 'Tidak Berlaku',
            self::REVOKED => 'Dicabut',
            self::AMENDED => 'Diubah',
            self::DRAFT => 'Dalam Proses',
        };
    }

    public function color(): string
    {
        return match($this) {
            self::ACTIVE => 'green',
            self::INACTIVE => 'red',
            self::REVOKED => 'slate',
            self::AMENDED => 'blue',
            self::DRAFT => 'orange',
        };
    }
}
