<?php

namespace App\Models;

use App\Entities\Activity;
use App\Entities\MeetingRoom;
use App\Entities\Reservation;
use App\Entities\Room;
use CodeIgniter\Model;

class ReservationModel extends Model
{
    protected $table            = 'reservations';
    protected $primaryKey       = 'r_id';
    protected $useAutoIncrement = true;
    protected $returnType       = Reservation::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['r_starting_date', 'r_ending_date', 'r_meal_option', 'r_number_people', 'r_total_price', 'r_status', 'r_type', 'u_fk_id'];

    protected bool $allowEmptyInserts = true;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'r_created_at';
    protected $updatedField  = 'r_updated_at';
    protected $deletedField  = 'r_deleted_at';

    // Validation
    protected $validationRules      = [
        'r_starting_date' => 'required|valid_date',
        'r_ending_date'   => 'required|valid_date',
        'r_type'          => 'required|in_list[Chambre,Activité,Salle de réunion,Transport]',
        'r_meal_option'   => 'required|in_list[Pension-Compléte,Demi-Pension,Sans-Pension]',
        'r_number_people' => 'required|integer|greater_than[0]|less_than[500]',
        'r_total_price'   => 'required|decimal|greater_than[0]|less_than[1000]',
        'r_status'        => 'required|in_list[Confirmée,En attente,Annulée]',
        'u_fk_id'         => 'required|integer|greater_than[0]',
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    /**
     * @param int $reservationId
     * @return ?Room[]
     */
    public function getRoomsByReservation(int $reservationId): ?array
    {
        // @TODO récupérer les chambres d'une réservation via leur table de liaison
    }

//    /**
//     * @param int $reservationId
//     * @param string[] $roomsNum
//     */
//    public function addRoomsToReservation(int $reservationId, array $roomsNum): void
//    {
//        // @TODO méthode pour ajouter des chambres à une réservation via leur table de liaison
//    }

    /**
     * @param int $reservationId
     * @return ?MeetingRoom[]
     */
    public function getMeetingRoomsByReservation(int $reservationId): ?array
    {
        $builder = $this->db->table('reservations_meeting_rooms')
            ->join('meeting_rooms', 'reservations_meeting_rooms.mr_fk_number = meeting_rooms.mr_number')
            ->where('reservations_meeting_rooms.r_fk_id', $reservationId);
        return $builder->get()->getResult('App\Entities\MeetingRoom');
    }

//    /**
//     * @param int $reservationId
//     * @param string[] $meetingRoomsNum
//     * @return bool
//     */
//    public function addMeetingRoomsToReservation(int $reservationId, array $meetingRoomsNum): bool
//    {
//        $insertData = [];
//        foreach ($meetingRoomsNum as $meetingRoomNum) {
//            $insertData = [
//                'r_fk_id' => $reservationId,
//                'mr_fk_num' => $meetingRoomNum
//            ];
//        }
//
//        $this->db->transStart();
//        $this->db->table('reservations_meeting_rooms')->insertBatch($insertData);
//        $this->db->transComplete();
//
//        return $this->db->transStatus();
//    }

    /**
     * @param int $reservationId
     * @return ?Activity[]
     */
    public function getActivitiesByReservation(int $reservationId): ?array
    {
        $builder = $this->db->table('reservations_activities')
            ->join('activities', 'reservations_activities.a_fk_id = activities.a_id')
            ->where('reservations_activities.r_fk_id', $reservationId);
        return $builder->get()->getResult('App\Entities\Activity');
    }

//    /**
//     * @param int $reservationId
//     * @param int[] $activitiesId
//     * @return bool
//     */
//    public function addActivitiesToReservation(int $reservationId, array $activitiesId): bool
//    {
//        $insertData = [];
//        foreach ($activitiesId as $activityId) {
//            $insertData = [
//                'r_fk_id' => $reservationId,
//                'a_fk_id' => $activityId
//            ];
//        }
//
//        $this->db->transStart();
//        $this->db->table('reservations_activities')->insertBatch($insertData);
//        $this->db->transComplete();
//
//        return $this->db->transStatus();
//    }

    /**
     * @param int $userId
     * @return ?Reservation[]
     */
    public function getReservationsByUser(int $userId): ?array
    {
        return $this->where('u_fk_id', $userId)->findAll();
    }
}
