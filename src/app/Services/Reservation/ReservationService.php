<?php

namespace App\Services\Reservation;

use App\Entities\Reservation;
use App\Models\ReservationModel;
use PHPUnit\Framework\Exception;
use ReflectionException;

class ReservationService
{
    public static function save(BaseReservation $reservation): void
    {
        $success = null;
        $db = \Config\Database::connect();
        $db->transStart();

        try {
            $reservationModel = new ReservationModel();
            $reservationEntity = new Reservation();
            $reservationEntity->fill($reservation->getData());
            $reservationSuccess = $reservationModel->save($reservationEntity);
            if (!$reservationSuccess) {
                $db->transRollback();
                throw new Exception(implode('<br>', $reservationModel->errors()));
            }

            $reservationId = $db->insertID();

            if ($reservation instanceof RoomReservation) {
                // @TODO insérer les données de la réservation et de la chambre dans 'reservations_rooms'
            } elseif ($reservation instanceof MeetingRoomReservation) {
                $success = $db->table('reservations_meeting_rooms')->insert(['r_fk_id' => $reservationId, 'mr_fk_number' => $reservation->getId()]);
            } elseif ($reservation instanceof ActivityReservation) {
                // @TODO insérer les données de la réservation et de la chambre dans 'reservations_activities'
            } else {
                throw new Exception('Type de réservation non valide.');
            }

            if (!$success) {
                $db->transRollback();
                throw new Exception(implode('<br>', $reservationModel->errors()));
            }

            $db->transComplete();
        } catch (ReflectionException $e) {
            $db->transRollback();
            throw new Exception("Erreur lors de l'enregistrement de la réservation.");
        }
    }
}