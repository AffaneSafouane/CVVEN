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
        // TODO: afficher toutes les chambres disponibles, getAvailableRooms() de RoomModel
    }

    public function show(int $roomId): string
    {
        // TODO: afficher les détails d'une chambre spécifique
    }

    public function search(): string
    {
        // TODO: recherche de logements en fonction des critères (dates, nombre de personnes, type, prix, etc.)
    }

    /**
     * Donner un objet de type Room au formulaire
     */
    public function new(int $roomId): string
    {
        // TODO: afficher le formulaire pour une chambre (reservations/create)
    }
}
