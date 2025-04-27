<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RoomModel;
use CodeIgniter\HTTP\ResponseInterface;

class RoomController extends BaseController
{
    public function index(): string
    {
        $start = $this->request->getGet('start');
        $end   = $this->request->getGet('end');

        $model = new RoomModel();

        // Si dates fournies, on filtre, sinon on affiche tout
        if ($start && $end) {
            $rooms = $model->getAvailableRooms($start, $end);
        } else {
            $rooms = $model->findAll();
        }

        return view('rooms/index', [
            'title' => 'Nos chambres',
            'rooms' => $rooms,
            'start' => $start,
            'end'   => $end,
        ]);
    }

    public function show(int $roomId): string
    {
        $room = (new RoomModel())->find($roomId);

        if (! $room) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Chambre #{$roomId} introuvable");
        }

        return view('rooms/show', [
            'title' => "Chambre {$room->num}",
            'room'  => $room,
        ]);
    }

    public function newReservation(int $roomId): string
    {
        $room = (new RoomModel())->find($roomId);

        if (! $room) {
            return redirect()->to('rooms')->with('error', 'Chambre non trouvée');
        }

        return view('reservations/create', [
            'title'           => "Réserver la chambre {$room->num}",
            'id'              => $room->id,
            'capacity'        => $room->capacity,
        ]);
    }
}
