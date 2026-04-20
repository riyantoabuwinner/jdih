<?php

namespace App\Enums;

enum DocumentStatus: string
{
    case DRAFT = 'draft';
    case REVIEW = 'review';
    case PUBLISHED = 'published';
    case ARCHIVED = 'archived';

    public function label(): string
    {
        return match($this) {
            self::DRAFT => 'Draft',
            self::REVIEW => 'Dalam Review',
            self::PUBLISHED => 'Diterbitkan',
            self::ARCHIVED => 'Diarsipkan',
        };
    }

    public function color(): string
    {
        return match($this) {
            self::DRAFT => 'gray',
            self::REVIEW => 'yellow',
            self::PUBLISHED => 'green',
            self::ARCHIVED => 'red',
        };
    }
}
