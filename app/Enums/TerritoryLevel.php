<?php

namespace App\Enums;

enum TerritoryLevel: string
{
    case NATIONAL = 'national';
    case PROVINCIAL = 'provincial';
    case REGIONAL = 'regional';
    case INTERNAL = 'internal';

    public function label(): string
    {
        return match($this) {
            self::NATIONAL => 'Nasional',
            self::PROVINCIAL => 'Provinsi',
            self::REGIONAL => 'Kabupaten / Kota',
            self::INTERNAL => 'Internal Institusi',
        };
    }
}
