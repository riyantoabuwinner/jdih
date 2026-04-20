<?php

namespace App\Enums;

enum UserRole: string
{
    case SUPER_ADMIN = 'super_admin';
    case ADMIN = 'admin';
    case EDITOR = 'editor';
    case VALIDATOR = 'validator';
    case PEJABAT = 'pejabat';
    case GUEST = 'guest';

    public function label(): string
    {
        return match($this) {
            self::SUPER_ADMIN => 'Super Admin',
            self::ADMIN => 'Admin JDIH',
            self::EDITOR => 'Editor',
            self::VALIDATOR => 'Validator (Legal)',
            self::GUEST => 'Public Guest',
        };
    }
}
