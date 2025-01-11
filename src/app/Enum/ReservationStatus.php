<?php

namespace App\Enum;

enum ReservationStatus: string
{
    case Confirmed = 'Confirmed';
    case Cancelled = 'Cancelled';
    case Pending = 'Pending';

    public function getLabel(): string
    {
        return match ($this) {
            self::Confirmed => 'Confirmée',
            self::Cancelled => 'Annulée',
            self::Pending => 'En attente',
        };
    }
}
