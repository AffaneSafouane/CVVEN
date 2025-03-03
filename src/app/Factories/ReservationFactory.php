<?php

namespace App\Factories;

use App\Services\Reservation\ActivityReservation;
use App\Services\Reservation\MeetingRoomReservation;
use App\Services\Reservation\RoomReservation;
use Exception;

class ReservationFactory
{
    /**
     * @throws Exception
     */
    public static function create(string $reservationType, array $data): RoomReservation|MeetingRoomReservation|ActivityReservation
    {
        return match ($reservationType) {
            'Chambre' => new RoomReservation($data),
            'Salle de réunion' => new MeetingRoomReservation($data),
            'Activité' => new ActivityReservation($data),
            default => throw new Exception("Type de réservation inconnu"),
        };
    }
}