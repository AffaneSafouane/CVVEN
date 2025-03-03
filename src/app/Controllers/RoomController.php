<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Enum\ReservationType;
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
        // @TODO afficher toutes les chambres disponibles
    }

    public function show(?string $roomNum): string
    {
        // @TODO afficher les détails d'une chambre
    }

    /**
     * Donner un objet de type Room pour nb de personnes et dates.
     */
    public function new(string $roomNum, $type = ReservationType::Room): string
    {
        // @TODO afficher le formulaire pour une chambre
    }
}
