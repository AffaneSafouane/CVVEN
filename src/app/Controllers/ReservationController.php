<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\Reservation;
use App\Models\ReservationModel;
use App\Models\RoomModel;
use App\Models\ClientModel;
use App\Enum\FamilyQuotient;
use CodeIgniter\HTTP\RedirectResponse;

class ReservationController extends BaseController
{
    /**
     * Affiche la liste des réservations de l'utilisateur connecté
     */
    public function index(): string
    {
        $userId           = auth()->id();
        $reservationModel = new ReservationModel();
        $reservations     = $reservationModel->getClientReservations($userId) ?: [];

        return view('reservations/index', [
            'title'        => 'Mes réservations',
            'reservations' => $reservations,
        ]);
    }

    /**
     * Affiche le détail d'une réservation si elle appartient à l'utilisateur
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
     * Affiche la page de confirmation avant création,
     * avec calcul du nombre de nuits, des extras et de la réduction
     */
    public function confirm(): string|RedirectResponse
    {
        $data = session('reservation_data');
        if (! $data) {
            return redirect()->to('rooms')->with('error', 'Aucune réservation en cours à confirmer');
        }

        $roomModel   = new RoomModel();
        $clientModel = new ClientModel();

        $room   = $roomModel->find($data['room_id']);
        $client = $clientModel->find(auth()->id());

        // Calcul du nombre de nuits
        $start    = new \DateTime($data['start_date']);
        $end      = new \DateTime($data['end_date']);
        $interval = $start->diff($end);
        $nights   = $interval->days;

        // Prix de base
        $basePrice = $room->price * $nights;

        // Extra pension
        $pensionExtra = match ($data['meal_option']) {
            'Pension-Compléte' => 50,
            'Demi-Pension'     => 30,
            default            => 0,
        };

        // Option ménage
        $cleaningFee = ! empty($data['cleaning_option']) ? 30 : 0;

        // Récupère l'enum FamilyQuotient depuis la chaîne
        $fqEnum       = FamilyQuotient::tryFrom($client->familyQuotient) 
                       ?? FamilyQuotient::LESS_800;
        // Réduction quotient familial via le modèle
        $discountRate = $clientModel->getFamilyQuotaDiscount($fqEnum);
        $discount     = $basePrice * $discountRate;

        // Total final
        $totalPrice = ($basePrice + $pensionExtra + $cleaningFee) - $discount;

        return view('reservations/confirm', [
            'title'        => 'Confirmation de la réservation',
            'data'         => $data,
            'room'         => $room,
            'nights'       => $nights,
            'basePrice'    => $basePrice,
            'pensionExtra' => $pensionExtra,
            'cleaningFee'  => $cleaningFee,
            'discount'     => $discount,
            'totalPrice'   => $totalPrice,
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

        $reservation = new Reservation();
        $reservation->startDate      = $data['start_date'];
        $reservation->endDate        = $data['end_date'];
        $reservation->mealOption     = $data['meal_option'];
        $reservation->cleaningOption = ! empty($data['cleaning_option']);
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
                             ->with('success', 'Votre réservation a été créée avec succès !');
        } catch (\Exception $e) {
            return redirect()->back()
                             ->with('error', $e->getMessage())
                             ->withInput();
        }
    }

    /**
     * Annule une réservation (statut "Annulée") si elle appartient à l'utilisateur
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
     * Supprime définitivement une réservation si elle appartient à l'utilisateur
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
