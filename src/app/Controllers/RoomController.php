<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * Description of RoomController
 *
 * @author Sisakoun Matthew, Krouch Kellyann
 */
class RoomController extends BaseController
{
    /**
     * Réservations uniquement pendant les vacances scolaires.
     */
    public function index(): string
    {
        // TODO: afficher toutes les chambres disponibles, getAvailableRooms() de RoomModel, selon les dates (filtre à mettre en place dans Views/rooms/index)
    }

    public function show(int $roomId): string
    {
        // TODO: afficher les détails d'une chambre spécifique
    }

    /**
     * Donner un objet de type Room au formulaire
     */
    public function newReservation(int $roomId): string
    {
        // TODO: afficher le formulaire pour une chambre (Views/reservations/create)
    }
}
