<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RoomModel;
use CodeIgniter\HTTP\ResponseInterface;

class RoomController extends BaseController
{
    public function index(): string
    {
        $model = model(RoomModel::class);

        $data = [
            'rooms' => $model->findAll(),
            'title' => 'Liste des chambres'
        ];

        return view('room/index', $data);
    }
}
