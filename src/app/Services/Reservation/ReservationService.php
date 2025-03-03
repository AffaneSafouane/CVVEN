<?php

namespace App\Services\Reservation;

use App\Models\ReservationModel;
use PHPUnit\Framework\Exception;
use ReflectionException;

class ReservationService
{
    public static function save(BaseReservation $reservation): void
    {
        $db = \Config\Database::connect();
        $db->transStart();

        try {
            $reservationModel = new ReservationModel();
            $reservationModel->save($reservation);
            $reservationId = $db->insertID();

            if ($reservation instanceof RoomReservation) {
                // @TODO insérer les données de la réservation et de la chambre dans 'reservations_rooms'
            } elseif ($reservation instanceof MeetingRoomReservation) {
                $db->table('reservations_meeting_rooms')->insert(['r_fk_id' => $reservationId, 'mr_fk_num' => $reservation->getData()->id]);
            } elseif ($reservation instanceof ActivityReservation) {
                // @TODO insérer les données de la réservation et de la chambre dans 'reservations_activities'
            }

            $db->transComplete();
        } catch (ReflectionException $e) {
            $db->transRollback();
            throw new Exception("Erreur lors de l'enregistrement de la réservation.");
        }
    }
}