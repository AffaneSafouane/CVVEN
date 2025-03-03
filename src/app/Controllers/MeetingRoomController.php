<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Enum\ReservationType;
use CodeIgniter\HTTP\ResponseInterface;

class MeetingRoomController extends BaseController
{
    /**
     * Salle de réunions disponible pendant les vacances de pâques, de la toussaint et de noël.
     */
    public function index(): string
    {
        // @TODO afficher toutes les salles de réunion disponible
    }

    public function show(?string $meetingRoomNum): string
    {
        // @TODO afficher les détails d'une salle de réunion
    }

    /**
     * Donner l'id de la salle de réunion pour dates et nb de personnes.
     */
    public function new(string $meetingRoomNum, $type = ReservationType::MeetingRoom): string
    {
        helper('form');

        $data['reservationType'] = $type;
        $data['id'] = $meetingRoomNum;
        return view('reservations/create', $data);
    }
}
