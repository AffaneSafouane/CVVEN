<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\Reservation;
use App\Models\ReservationModel;
use CodeIgniter\HTTP\RedirectResponse;
use Exception;

class ReservationController extends BaseController
{
    public function index(): string
    {
        // TODO: afficher toutes les réservations de l'utilisateur connecté avec getUserReservations() de ReservationModel
    }

    public function show(int $reservationId): string
    {
        // TODO: afficher les détails d'une réservation
    }

    public function create(): RedirectResponse
    {
        // TODO: Créer une réservation de chambre en appelant createReservation() de ReservationModel
    }

    public function edit(int $reservationId): RedirectResponse
    {
        // TODO: Vérifier que l'utilisateur connecté correspond à l'utilisateur de la réservation puis update une reservation
    }

    public function delete(int $reservationId): RedirectResponse
    {
        // TODO: Vérifier que l'utilisateur connecté correspond à l'utilisateur de la réservation puis delete une reservation
    }

    public function cancel(int $reservationId): RedirectResponse
    {
        // TODO: Vérifier que l'utilisateur connecté correspond à l'utilisateur de la réservation puis appel cancelReservation() de ReservationModel
    }
}