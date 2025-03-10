<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\RoomModel;
use CodeIgniter\HTTP\RedirectResponse;

class RoomController extends BaseController
{
    // @TODO rendre cette classe uniquement accessible aux administrateurs
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
        // TODO: afficher les détails d'une chambre spécifique
    }

    public function create(): RedirectResponse
    {
        // TODO: Créer une nouvelle chambre
    }

    public function update(int $roomId): RedirectResponse
    {
        // TODO: Mettre à jour les infos d'une chambre
    }

    public function delete(int $roomId): RedirectResponse
    {
        // TODO: Supprimer une chambre
    }
}
