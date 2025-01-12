<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ReservationModel;

class ReservationController extends BaseController
{
    public function index(): string
    {
        $model = model(ReservationModel::class);

        $data = [
            'reservations' => $model->findAll(),
            'title' => 'Liste des réservations',
        ];

        return view('admin/reservation/index', $data);
    }
}
