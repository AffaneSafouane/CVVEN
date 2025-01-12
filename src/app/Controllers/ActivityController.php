<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ActivityModel;
use CodeIgniter\HTTP\ResponseInterface;

class ActivityController extends BaseController
{
    public function index(): string
    {
        $model = new ActivityModel();

        $data = [
            'activities' => $model->findAll(),
            'title' => 'Liste des activités',
        ];

        return view('activity/index', $data);
    }
}
