<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\RoomModel;

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
}
