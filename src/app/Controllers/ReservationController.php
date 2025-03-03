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
    /**
     * Une réservation comporte le nombre de personnes (différent selon le type), les dates de début et fin, la pension, le prix (prix type), le type (Chambre...), le status (en attente jusqu'à confirmation admin)
     * Une chambre à un nombre limite de personnes (différent selon le type), on doit vérifier qu'elle n'est pas reservé aux dates demandées (RoomModel isRoomAvailable()), que les dates sont pendant les vacances scolaires (BookingDateValidator isRoomDateValid()), + si l'option ménage est sélectionnée ou non
     * Une activité à un nombre limite de personnes (différent selon le type), on doit vérifier s'il reste de la place (ActivityModel isActivityFull()), elles ont des dates prédéfinies
     * Une salle de réunion à un nombre limite de personnes (différent selon le type), on doit vérifier qu'elle n'est pas reservé aux dates demandées (RoomModel isRoomAvailable()), que les dates sont pendant les vacances scolaires (BookingDateValidator isMeetingRoomDateValid())
     * La fonction recevra un objet du type de la réservation (Room, MeetingRoom, Activity) pour déterminer les spécificités de chaque réservations
     * Elle gère tous les types de réservations avec ReservationFactory.
     * Le type de réservation est donné via la méthode new() des différents controllers.
     * Les insertions dans la base de données sont gérés par le service ReservationService qui gère les insertions complexes avec des transactions.
     */
    public function create(): RedirectResponse
    {
        try {
            $reservation = ReservationFactory::create($this->request->getPost('reservationType'), $this->request->getPost());
            $reservation->validate();
            ReservationService::save($reservation);
            return redirect()->to('/reservations')->with('success', 'Reservation créée !');
        } catch (Exception $exception) {
            return redirect()->back()->withInput()->with('error', $exception->getMessage());
        }
    }

    public function edit(int $reservationId): string|RedirectResponse
    {
        // @TODO...
    }

    public function delete(int $reservationId): string|RedirectResponse
    {
        // @TODO...
    }
}