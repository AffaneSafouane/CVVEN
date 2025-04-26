<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\Shield\Exceptions\UserNotFoundException;

class UserController extends BaseController
{
    public function index(): string
    {
        $model = model(UserModel::class);

        $data = [
            'users'     => $model->paginate(10),
            'pager'     => $model->pager,
            'title'     => 'Liste des utilisateurs',
        ];

        if ($data['users'] === null) {
            throw new UserNotFoundException('Impossible de trouver des utilisateurs');
        }

        return view('admin/users/index', $data);
    }

    public function show(int $userId): string
    {
        $userModel = new UserModel();

        $data = [
            'user' => $userModel->find($userId),
            'title' => "Informations client",
        ];

        return view('admin/users/show', $data);
    }

    public function updateRole(): RedirectResponse
    {
        // TODO: Mettre à jour le role d'un utilisateur (le rendre admin)
    }

    public function suspend(int $userId): RedirectResponse
    {
        // TODO: suspendre le compte d'un utilisateur
    }

    public function delete(int $userId): RedirectResponse
    {
        // TODO: supprimer un utilisateur
    }
}