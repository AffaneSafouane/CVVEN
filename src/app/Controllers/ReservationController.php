<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\Reservation;
use App\Models\ReservationModel;
use CodeIgniter\HTTP\RedirectResponse;

class ReservationController extends BaseController
{
    /**
     * Affiche la liste des réservations de l'utilisateur connecté
     */
    public function index(): string
    {
        $userId            = auth()->id();
        $reservationModel  = new ReservationModel();
        $reservations      = $reservationModel->getClientReservations($userId) ?: [];

        return view('reservations/index', [
            'title'        => 'Mes réservations',
            'reservations' => $reservations,
        ]);
    }

    /**
     * Affiche le détail d'une réservation, si elle appartient bien à l'utilisateur
     */
    public function show(int $reservationId): string|RedirectResponse
    {
        $reservationModel = new ReservationModel();
        $reservation      = $reservationModel->find($reservationId);

        if (! $reservation || $reservation->clientId !== auth()->id()) {
            return redirect()->back()->with('error', 'Réservation introuvable ou accès refusé');
        }

        return view('reservations/show', [
            'title'       => 'Détails de la réservation',
            'reservation' => $reservation,
        ]);
    }

    /**
     * Crée une nouvelle réservation à partir des données en session
     */
    public function create(): RedirectResponse
    {
        $data = session('reservation_data');
        if (! $data) {
            return redirect()->to('rooms')->with('error', 'Données de réservation manquantes');
        }

        // Prépare l'entité Reservation
        $reservation = new Reservation();
        $reservation->startDate      = $data['start_date'];
        $reservation->endDate        = $data['end_date'];
        $reservation->mealOption     = $data['meal_option']     ?? 'Sans-Pension';
        $reservation->cleaningOption = $data['cleaning_option'] ?? false;
        $reservation->numberOfPeople = $data['adults'] + $data['children'] + $data['animals'];
        $reservation->status         = 'En attente';
        $reservation->clientId       = auth()->id();

        $reservationModel = new ReservationModel();

        try {
            $reservationModel->createReservation(
                $reservation,
                $data['room_id'],
                auth()->id()
            );
            session()->remove('reservation_data');
            return redirect()->to('reservations')
                             ->with('success', 'Votre réservation a bien été enregistrée !');
        } catch (\Exception $e) {
            return redirect()->back()
                             ->with('error', $e->getMessage())
                             ->withInput();
        }
    }

    /**
     * Annule une réservation (si elle appartient à l'utilisateur)
     */
    public function cancel(int $reservationId): RedirectResponse
    {
        $reservationModel = new ReservationModel();
        $reservation      = $reservationModel->find($reservationId);

        if (! $reservation || $reservation->clientId !== auth()->id()) {
            return redirect()->back()->with('error', 'Accès refusé');
        }

        if ($reservationModel->cancelReservation($reservationId)) {
            return redirect()->to('reservations')
                             ->with('success', 'Réservation annulée avec succès');
        }

        return redirect()->back()->with('error', 'Impossible d’annuler la réservation');
    }

    /**
     * Supprime une réservation définitivement (si elle appartient à l'utilisateur)
     */
    public function delete(int $reservationId): RedirectResponse
    {
        $reservationModel = new ReservationModel();
        $reservation      = $reservationModel->find($reservationId);

        if (! $reservation || $reservation->clientId !== auth()->id()) {
            return redirect()->back()->with('error', 'Accès refusé');
        }

        if ($reservationModel->delete($reservationId)) {
            return redirect()->to('reservations')
                             ->with('success', 'Réservation supprimée avec succès');
        }

        return redirect()->back()->with('error', 'Impossible de supprimer la réservation');
    }
}
