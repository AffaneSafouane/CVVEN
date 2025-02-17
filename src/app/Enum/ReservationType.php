<?php

namespace App\Enum;

enum ReservationType: string
{
    case Room = 'Room';
    case Activity = 'Activity';
    case MeetingRoom = 'Meeting Room';
    case Transport = 'Transport';

    public function getLabel(): string
    {
        return match ($this) {
            self::Room => 'Chambre',
            self::Activity => 'Activité',
            self::MeetingRoom => 'Salle de réunion',
            self::Transport => 'Transport',
        };
    }
}
