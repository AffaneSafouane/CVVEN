<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\RoomModel;
use CodeIgniter\HTTP\RedirectResponse;

class RoomController extends BaseController
{
    public function index(): string
    {
        $model = model(RoomModel::class);

        $data = [
            'rooms' => $model->paginate(10),
            'pager' => $model->pager,
            'title' => 'Liste des chambres'
        ];

        return view('admin/rooms/index', $data);
    }

    public function show(int $roomId): string
    {
        $roomModel = new RoomModel();
        $data = [
            'room' => $roomModel->find($roomId),
            'title' => 'Informations chambre',
        ];

        return view('admin/rooms/show', $data);
    }

    public function create(): RedirectResponse
    {
        // TODO: Créer une nouvelle chambre
    }

    public function update(int $roomId): RedirectResponse
    {
        $roomModel = new RoomModel();
        $data = [
            'room' => $roomModel->find($roomId),
            'title' => 'Informations chambre',
        ];

        return view('admin/rooms/edit', $data);
    }

    public function delete(int $roomId): RedirectResponse
    {
        // TODO: Supprimer une chambre
    }
}
