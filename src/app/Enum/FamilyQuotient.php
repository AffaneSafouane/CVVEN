<?php

namespace App\Enum;

enum FamilyQuotient: string
{
    case LESS_800 = 'less_800';
    case BETWEEN_800_1200 = '800-1200';
    case BETWEEN_1200_1800 = '1200-1800';
    case BETWEEN_1800_2500 = '1800-2500';
    case MORE_2500 = 'more_2500';

    public function getLabel(): string
    {
        return match ($this) {
            self::LESS_800 => 'Moins de 800 euros',
            self::BETWEEN_800_1200 => 'Entre 800 et 1200 euros',
            self::BETWEEN_1200_1800 => 'Entre 1200 et 1800 euros',
            self::BETWEEN_1800_2500 => 'Entre 1800 et 2500 euros',
            self::MORE_2500 => 'Plus de 2500 euros',
        };
    }
}
