<?php

namespace App\Enums;

enum CategoryType: string
{
    case LEGAL_TYPE = 'legal_type'; // Jenis Produk Hukum
    case SUBJECT = 'subject';     // Bidang Hukum
    case CLUSTER = 'cluster';     // Klaster Informasi (Peleburan)
    case TERRITORY = 'territory'; // Tingkat Wilayah
    case FUNCTION = 'function';   // Fungsi Dokumen

    public function label(): string
    {
        return match($this) {
            self::LEGAL_TYPE => 'Jenis Produk Hukum',
            self::SUBJECT => 'Bidang Hukum',
            self::CLUSTER => 'Klaster Informasi',
            self::TERRITORY => 'Tingkat Wilayah',
            self::FUNCTION => 'Fungsi Dokumen',
        };
    }
}
