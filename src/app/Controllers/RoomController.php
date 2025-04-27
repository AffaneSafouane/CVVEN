<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RoomModel;
use CodeIgniter\HTTP\RedirectResponse;

class RoomController extends BaseController
{
    /**
     * Affiche la liste des chambres (avec filtre optionnel par dates)
     */
    public function index(): string
    {
        $start = $this->request->getGet('start');
        $end   = $this->request->getGet('end');

        $roomModel = new RoomModel();

        if ($start && $end) {
            // Filtre par disponibilité
            $rooms = $roomModel->getAvailableRooms($start, $end) ?: [];
        } else {
            // Sans filtre : toutes les chambres
            $rooms = $roomModel->findAll();
        }

        return view('rooms/index', [
            'title'  => 'Chambres disponibles',
            'rooms'  => $rooms,
            'start'  => $start,
            'end'    => $end,
        ]);
    }

    /**
     * Affiche les détails d'une chambre
     */
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

    /**
     * Affiche le formulaire de réservation pour une chambre donnée
     */
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
     * Traite la soumission du formulaire de réservation,
     * stocke les données en session et redirige vers la confirmation
     */
    public function submitReservation(int $roomId): RedirectResponse
    {
        // Récupère les données POST
        $data = $this->request->getPost([
            'start_date',
            'end_date',
            'adults',
            'children',
            'animals',
        ]);

        // On inclut l'ID de la chambre
        $data['room_id'] = $roomId;

        // Stocke en session pour la confirmation ultérieure
        session()->set('reservation_data', $data);

        return redirect()->to('/reservations/confirm');
    }
}
