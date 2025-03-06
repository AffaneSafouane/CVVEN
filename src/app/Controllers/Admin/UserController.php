<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\Shield\Exceptions\UserNotFoundException;

class UserController extends BaseController
{
    // @TODO rendre cette classe uniquement accessible aux administrateurs
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

    // @TODO Ajouter les méthodes show(), updateRole(), delete(), suspend()
}