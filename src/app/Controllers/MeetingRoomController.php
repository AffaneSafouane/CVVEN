<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MeetingRoomModel;
use CodeIgniter\HTTP\ResponseInterface;

class MeetingRoomController extends BaseController
{
    public function index(): string
    {
        $model = model(MeetingRoomModel::class);

        $data = [
            'meetingRooms' => $model->findAll(),
            'title' => 'Liste des salles de réunions'
        ];

        return view('meetingRoom/index', $data);
    }
}
