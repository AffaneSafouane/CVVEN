<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ReservationModel;
use App\Entities\Reservation;
use CodeIgniter\HTTP\RedirectResponse;

class ReservationController extends BaseController
{
    public function index(): string
    {
        $userId = auth()->id();
        $model  = new ReservationModel();

        $reservations = $model->getClientReservations($userId);

        return view('reservations/index', [
            'title'        => 'Mes réservations',
            'reservations' => $reservations,
        ]);
    }

    public function show(int $reservationId): string
    {
        $reservation = (new ReservationModel())->find($reservationId);

        if (! $reservation || $reservation->clientId !== auth()->id()) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Réservation introuvable");
        }

        return view('reservations/show', [
            'title'       => "Réservation #{$reservation->id}",
            'reservation' => $reservation,
        ]);
    }

    public function create(): RedirectResponse
    {
        $post = $this->request->getPost();
        $model = new ReservationModel();

        if ($model->createReservation(
            new Reservation([
                'start_date'     => $post['start'],
                'end_date'       => $post['end'],
                'meal_option'    => $post['pensionType'],
                'cleaning_option'=> $post['cleaningOption'],
                'number_people'  => $post['nbPeople'],
                'status'         => 'En attente',
                'client_id'      => auth()->id(),
            ]),
            (int)$post['id'],
            auth()->id()
        )) {
            return redirect()->to('reservations')->with('success', 'Réservation créée.');
        }

        return redirect()->back()->withInput()->with('error', 'Échec de la réservation.');
    }

    public function edit(int $reservationId): RedirectResponse
    {
        // à implémenter (similaire à create mais en update)
    }

    public function delete(int $reservationId): RedirectResponse
    {
        $model = new ReservationModel();
        $res   = $model->find($reservationId);

        if (! $res || $res->clientId !== auth()->id()) {
            return redirect()->back()->with('error', 'Accès refusé');
        }

        $model->delete($reservationId);
        return redirect()->to('reservations')->with('success', 'Réservation supprimée.');
    }

    public function cancel(int $reservationId): RedirectResponse
    {
        $model = new ReservationModel();
        $res   = $model->find($reservationId);

        if (! $res || $res->clientId !== auth()->id()) {
            return redirect()->back()->with('error', 'Accès refusé');
        }

        if ($model->cancelReservation($reservationId)) {
            return redirect()->to("reservations/{$reservationId}")
                   ->with('success', 'Réservation annulée.');
        }

        return redirect()->back()->with('error', 'Impossible d’annuler.');
    }
}
