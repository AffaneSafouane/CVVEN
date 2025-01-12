<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\MeetingRoomModel;

class MeetingRoomController extends BaseController
{
    public function index(): string
    {
        $model = model(MeetingRoomModel::class);

        $data = [
            'meetingRooms' => $model->findAll(),
            'title' => 'Liste des salles de réunions'
        ];

        return view('admin/meetingRooms/index', $data);
    }
}
