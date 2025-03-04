<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Enum\ReservationType;
use App\Models\MeetingRoomModel;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\ResponseInterface;

class MeetingRoomController extends BaseController
{
    /**
     * Salle de réunions disponible pendant les vacances de pâques, de la toussaint et de noël.
     */
    public function index(): string
    {
        $meetingRoomModel = model(MeetingRoomModel::class);

        $data = [
            'meetingRooms' => $meetingRoomModel->paginate(10),
            'pager'        => $meetingRoomModel->pager,
            'title'        => 'Liste des salles de réunions',
        ];

        return view('meetingRooms/index', $data);
    }

    public function show(string $meetingRoomNum): string
    {
        $meetingRoomModel = new MeetingRoomModel();
        $meetingRoom = $meetingRoomModel->find($meetingRoomNum);

        $data = [
            'meetingRoom' => $meetingRoom,
            'title' => 'Détail salle de réunion',
        ];

        return view('meetingRooms/show', $data);
    }

    /**
     * Donner l'id de la salle de réunion pour dates et nb de personnes.
     */
    public function new(string $meetingRoomNum, $type = ReservationType::MeetingRoom): string|RedirectResponse
    {
        helper('form');

        $meetingRoomModel = new MeetingRoomModel();
        $meetingRoom = $meetingRoomModel->find($meetingRoomNum);

        if (!$meetingRoom) {
            return redirect()->back()->with('error', 'Salle de réunion introuvable.');
        }

        $data = [
            'id'                => $meetingRoom->num,
            'reservationType'   => $type,
            'capacity'          => $meetingRoom->capacity,
            'title'             => 'Réservation salle de réunion'
        ];

        return view('reservations/create', $data);
    }
}
