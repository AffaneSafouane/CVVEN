<?php

namespace App\Enum;

enum MealOption: string
{
    case FullPension = 'Full Pension';
    case HalfPension = 'Half Pension';
    case NoPension = 'No Pension';

    public function getLabel(): string
    {
        return match ($this) {
            self::FullPension => 'Pension Compléte',
            self::HalfPension => 'Demi-Pension',
            self::NoPension => 'Sans Pension',
        };
    }
}
