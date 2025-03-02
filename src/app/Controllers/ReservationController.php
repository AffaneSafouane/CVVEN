<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\Reservation;
use App\Models\MeetingRoomModel;
use App\Models\ReservationModel;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * Description of ReservationController
 *
 * @author Sisakoun Matthew, Krouch Kellyann, Affane Safouane
 */
class ReservationController extends BaseController
{
    public function index(): string
    {
        // @TODO afficher toutes les réservations de l'utilisateur connecté
    }

    public function show(int $reservationId): string
    {
        // @TODO afficher les détails d'une réservation
    }

    /**
     * La fonction recevra un objet du type de la réservation (Room, MeetingRoom, Activity).
     * Elle gère tous les types de réservations avec un switch.
     * Le type de réservation est donné via la méthode new() des différents controllers.
     * Il faudra ajouter des transactions pour les insertions dans la base de données.
     */
    public function create(): string|RedirectResponse
    {
        helper('form');

        $reservationType = $this->request->getPost('reservationType');
        $id = $this->request->getPost('id');

        switch ($reservationType) {
            case 'room':
                // @TODO Validations pour les chambres (nbPeople et cleaningOption)
                break;
            case 'activity':
                // @TODO Validations pour les activités (dates et nbPeople)
                break;
            case 'meeting_room':
                $meetingRoomModel = new MeetingRoomModel();
                $meetingRoom = $meetingRoomModel->find($id);
                if (!$meetingRoom) {
                    return redirect()->back()->withInput()->with('errors', $meetingRoomModel->errors());
                }

                $rules = [
                    'startingDate' => 'required|valid_date',
                    'endingDate'   => 'required|valid_date',
                    'mealOption'   => 'required|in_list[Full Pension, Half Pension, No Pension]',
                    'nbPeople'     => 'required|integer|greater_than[0]|less_than[197]',
                ];
                // @TODO Validations pour les salles de réunion (dates et nbPeople)
                break;
        }

        $data = $this->request->getPost(array_keys($rules));

        if (!$this->validate($data, $rules)) {
            return redirect()->back()->withInput()->with('errors', 'Erreur de validation');
        }

        $reservation = new Reservation();
        $reservationModel = new ReservationModel();
        try {
            switch ($reservationType) {
                case 'room':
                    // @TODO Insertion db chambres
                    break;
                case 'activity':
                    // @TODO Insertion db activités
                    break;
                case 'meeting_room':
                    // @TODO Insertion db salles de réunion
                    break;
            }
        } catch (\ReflectionException $e) {
            log_message('error', 'Erreur lors de l\'insertion dans la base de données' . $e->getMessage());
        }
    }
}
