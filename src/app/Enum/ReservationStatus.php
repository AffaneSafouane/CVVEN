<?php

namespace App\Enum;

enum ReservationStatus: string
{
    case Confirmed = 'Confirmée';
    case Cancelled = 'Annulée';
    case Pending = 'En attente';

    public function getLabel(): string
    {
        return $this->value;
    }
}
