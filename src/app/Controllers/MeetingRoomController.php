<?php

namespace App\Controllers;

use App\Controllers\BaseController;
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

    public function show(?int $meetingId): string
    {
        // @TODO afficher les détails d'une chambre
    }

    /**
     * Donner un objet de type MeetingRoom pour dates et nb de personnes.
     */
    public function new($type = "meeting_room"): string
    {
        helper('form');

        $data['reservationType'] = $type;
        return view('reservations/create', $data);
    }
}
