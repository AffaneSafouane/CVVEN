<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\Reservation;
use App\Models\ActivityModel;
use App\Models\MeetingRoomModel;
use App\Models\ReservationModel;
use App\Models\RoomModel;
use CodeIgniter\HTTP\RedirectResponse;
use App\Libraries\BookingDateValidator;

/**
 * Description of ReservationController
 *
 * @author Sisakoun Matthew, Krouch Kellyann, Affane Safouane
 */
class UserReservationController extends BaseController
{
    public function index(): string
    {
        // @TODO afficher toutes les réservations de l'utilisateur connecté
        $reservationModel = new ReservationModel();
        $reservations = $reservationModel->findAll();

        $data = [
            'reservations' => $reservations,
            'title' => "Liste de vos réservations"
        ];
        return view('reservations/index', $data);
    }

    public function show(int $reservationId): string
    {
        // @TODO afficher les détails d'une réservation
    }
}
