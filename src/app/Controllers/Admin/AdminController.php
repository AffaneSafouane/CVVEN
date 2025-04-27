<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ReservationModel;
use App\Models\RoomModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\Shield\Exceptions\ValidationException;

class AdminController extends BaseController
{
    public function dashboard(): string
    {
        $reservationModel = new ReservationModel();
        $roomModel = new RoomModel();

        // Get dashboard statistics
        $data = [
            'todayBookings' => $reservationModel->where('DATE(start_date)', date('Y-m-d'))->countAllResults(),
            'weekBookings' => $reservationModel->where('YEARWEEK(start_date)', date('YW'))->countAllResults(),
            'monthBookings' => $reservationModel->where('MONTH(start_date)', date('m'))
                ->where('YEAR(start_date)', date('Y'))->countAllResults(),
            'totalRooms' => $roomModel->countAllResults(),
            'upcomingBookings' => $reservationModel->getUpcomingReservations(5), // Get next 5 bookings
            'popularRooms' => $roomModel->getPopularRooms(5), // Get top 5 popular rooms
        ];

        return view('admin/dashboard', $data);
    }
}