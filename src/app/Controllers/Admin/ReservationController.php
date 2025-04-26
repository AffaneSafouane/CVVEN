<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ReservationModel;
use CodeIgniter\HTTP\RedirectResponse;

class ReservationController extends BaseController
{
    public function index(): string
    {
        // Récupérer les filtres
        $status = $this->request->getGet('status');
        $date = $this->request->getGet('date');

        // Initialiser le modèle de réservation
        $reservationModel = new ReservationModel();

        // Appliquer les filtres si nécessaire
        if ($status) {
            $reservationModel->where('status', $status);
        }

        if ($date) {
            $reservationModel->where('start_date <=', $date)
                ->where('end_date >=', $date);
        }

        // Construire les données à passer à la vue
        $data = [
            'reservations' => $reservationModel->paginate(10),
            'pager'        => $reservationModel->pager,
            'title'        => 'Liste des réservations',
            'status'       => $status,
            'date'         => $date,
        ];

        return view('admin/reservations/index', $data);
    }

    public function show(int $reservationId): string
    {
        $reservationModel = new ReservationModel();
        $data = [
            'reservation' => $reservationModel->find($reservationId),
            'title' => 'Informations réservation',
        ];

        return view('admin/reservations/show', $data);
    }

    public function delete(int $reservationId): RedirectResponse
    {
        $reservationModel = new ReservationModel();
        $reservation = $reservationModel->find($reservationId);
        if (!$reservation) {
            return redirect()->back()->with('error', 'Reservation non trouvée');
        }

        if (!$reservationModel->delete($reservationId)) {
            return redirect()->back()->with('errors', $reservationModel->errors());
        }

        return redirect()->to('/admin/reservations/')->with('success', 'Réservation supprimée avec succès');
    }

    public function confirm(int $reservationId): RedirectResponse
    {
        $reservationModel = new ReservationModel();
        $reservation = $reservationModel->find($reservationId);
        if (!$reservation) {
            return redirect()->back()->with('error', 'Reservation non trouvée');
        }

        if(!$reservationModel->confirmReservation($reservationId)) {
            return redirect()->back()->with('errors', $reservationModel->errors());
        }

        return redirect()->to('/admin/reservations/' . $reservationId)->with('success', 'Réservation confirmée avec succès');
    }

    public function cancel(int $reservationId): RedirectResponse
    {
        $reservationModel = new ReservationModel();
        $reservation = $reservationModel->find($reservationId);
        if (!$reservation) {
            return redirect()->back()->with('error', 'Reservation non trouvée');
        }

        if(!$reservationModel->cancelReservation($reservationId)) {
            return redirect()->back()->with('errors', $reservationModel->errors());
        }

        return redirect()->to('/admin/reservations/' . $reservationId)->with('success', 'Réservation annulée avec succès');
    }
}
