<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ActivityModel;

class ActivityController extends BaseController
{
    public function index(): string
    {
        $model = new ActivityModel();

        $data = [
            'activities' => $model->findAll(),
            'title' => 'Liste des activités',
        ];

        return view('admin/activities/index', $data);
    }
}
