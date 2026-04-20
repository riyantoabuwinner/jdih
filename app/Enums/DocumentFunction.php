<?php

namespace App\Enums;

enum DocumentFunction: string
{
    case REGULATIVE = 'regulative';
    case DECISION = 'decision';
    case OPERATIONAL = 'operational';
    case INFORMATIONAL = 'informational';

    public function label(): string
    {
        return match($this) {
            self::REGULATIVE => 'Regulatif (Mengatur)',
            self::DECISION => 'Penetapan (Decision)',
            self::OPERATIONAL => 'Operasional (Juknis/Juklak)',
            self::INFORMATIONAL => 'Informasional',
        };
    }
}
