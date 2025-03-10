<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ReservationModel;
use CodeIgniter\HTTP\RedirectResponse;

class ReservationController extends BaseController
{
    public function index(): string
    {
        $model = model(ReservationModel::class);

        $data = [
            'reservations' => $model->findAll(),
            'title' => 'Liste des réservations',
        ];

        return view('admin/reservations/index', $data);
    }

    public function show(int $reservationId): string
    {
        // TODO: Affiche les détails d'une réservation
    }

    public function edit(int $reservationId): RedirectResponse
    {
        // TODO: Vérifier que l'utilisateur connecté correspond à l'utilisateur de la réservation puis update une reservation
    }

    public function delete(int $reservationId): RedirectResponse
    {
        // TODO: Vérifier que l'utilisateur connecté correspond à l'utilisateur de la réservation puis delete une reservation
    }

    public function confirm(int $reservationId): RedirectResponse
    {
        // TODO: Valide la réservation d'un utilisateur (confirmReservation, ReservationModel)
    }

    public function cancel(int $reservationId): RedirectResponse
    {
        // TODO: Annule la réservation d'un utilisateur (cancelReservation, ReservationModel)
    }
}
