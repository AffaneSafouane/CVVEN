<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\Reservation;
use App\Factories\ReservationFactory;
use App\Services\Reservation\ReservationService;
use CodeIgniter\HTTP\RedirectResponse;
use Exception;

class ReservationController extends BaseController
{
    public function create(): RedirectResponse
    {
        helper('form');

        try {
            $reservation = ReservationFactory::create($this->request->getPost('type'), $this->request->getPost());
            $reservation->validate();
            ReservationService::save($reservation);
            return redirect()->to('/reservations')->with('success', 'Votre réservation a été créé avec succès et est en cours de confirmation !');
        } catch (Exception $exception) {
            return redirect()->back()->withInput()->with('error', $exception->getMessage());
        }
    }

    public function edit(int $reservationId): RedirectResponse
    {
        // @TODO...
    }

    public function delete(int $reservationId): RedirectResponse
    {
        // @TODO...
    }
}