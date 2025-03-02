<?php

namespace App\Enum;

enum MealOption: string
{
    case FullPension = 'Pension-Compléte';
    case HalfPension = 'Demi-Pension';
    case NoPension = 'Sans-Pension';

    public function getLabel(): string
    {
        return $this->value;
    }
}
