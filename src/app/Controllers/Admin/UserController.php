<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class UserController extends BaseController
{
    public function index(): string
    {
        // @TODO rendre accessible uniquement aux administrateurs
        $model = model(UserModel::class);

        $data = [
            'users'     => $model->paginate(10),
            'pager'     => $model->pager,
            'title'     => 'Liste des utilisateurs',
        ];

        return view('admin/users/index', $data);
    }
}