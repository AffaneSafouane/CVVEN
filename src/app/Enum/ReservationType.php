<?php

namespace App\Enum;

enum ReservationType: string
{
    case Room = 'Chambre';
    case Activity = 'Activité';
    case MeetingRoom = 'Salle de réunion';
    case Transport = 'Transport';

    public function getLabel(): string
    {
        return $this->value;
    }
}
