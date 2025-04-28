<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RoomModel;
use CodeIgniter\HTTP\RedirectResponse;

class RoomController extends BaseController
{
    public function index(): string
    {
        $start = $this->request->getGet('start');
        $end   = $this->request->getGet('end');

        $roomModel = new RoomModel();

        if ($start && $end) {
            $rooms = $roomModel->getAvailableRooms($start, $end) ?: [];
        } else {
            $rooms = $roomModel->findAll();
        }

        return view('rooms/index', [
            'title' => 'Chambres disponibles',
            'rooms' => $rooms,
            'start' => $start,
            'end'   => $end,
        ]);
    }

    public function show(int $roomId): string|RedirectResponse
    {
        $roomModel = new RoomModel();
        $room      = $roomModel->find($roomId);

        if (! $room) {
            return redirect()->to('rooms')->with('error', 'Chambre introuvable');
        }

        return view('rooms/show', [
            'title' => "Chambre {$room->num}",
            'room'  => $room,
        ]);
    }

    public function newReservation(int $roomId): string|RedirectResponse
    {
        $roomModel = new RoomModel();
        $room      = $roomModel->find($roomId);

        if (! $room) {
            return redirect()->to('rooms')->with('error', 'Chambre introuvable');
        }

        return view('reservations/create', [
            'title'    => "Réserver la chambre {$room->num}",
            'roomId'   => $room->id,
            'capacity' => $room->capacity,
        ]);
    }

    /**
     * Récupère start_date, calcule end_date = start_date + 7 jours,
     * puis stocke tout en session et redirige vers la confirmation.
     */
    public function submitReservation(int $roomId): RedirectResponse
    {
        $post = $this->request->getPost([
            'start_date',
            'adults',
            'children',
            'animals',
            'meal_option',
            'cleaning_option',
        ]);

        // cleaning_option binaire
        $post['cleaning_option'] = ! empty($post['cleaning_option']) ? 1 : 0;

        // Calcul automatique de la date de fin
        $dtStart = new \DateTime($post['start_date']);
        $dtEnd   = (clone $dtStart)->modify('+7 days');
        $post['end_date'] = $dtEnd->format('Y-m-d');

        $post['room_id'] = $roomId;

        session()->set('reservation_data', $post);

        return redirect()->to('/reservations/confirm');
    }
}
