<?php

namespace App\Models;

use App\Entities\MeetingRoom;
use App\Entities\Reservation;
use CodeIgniter\Model;

class MeetingRoomModel extends Model
{
    protected $table            = 'meeting_rooms';
    protected $primaryKey       = 'mr_number';
    protected $useAutoIncrement = false;
    protected $returnType       = MeetingRoom::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['mr_number', 'mr_type', 'mr_description', 'mr_capacity', 'mr_price', 'mr_available', 'r_fk_id'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';

    // Validation
    protected $validationRules      = [
        'mr_number'      => 'required|is_unique[meeting_rooms.mr_number]|regex_match[/\A[0-9]+\z/]|min_length[3]|max_length[3]',
        'mr_type'        => 'required|regex_match[/^[a-zA-Zàâäéèêëîïôöùûüç\'\-]+$/]|min_length[3]|max_length[50]',
        'mr_description' => 'required|min_length[10]|max_length[255]',
        'mr_capacity'    => 'required|integer|greater_than[0]|less_than[500]',
        'mr_price'       => 'required|decimal|greater_than[0]|less_than[500]',
        'mr_available'   => 'required|in_list[0,1]',
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
     * @param string $meetingRoomNum
     * @return ?Reservation[]
     */
    public function getReservationsByMeetingRoom(string $meetingRoomNum): ?array
    {
        $builder = $this->db->table('reservations_meeting_rooms')
            ->join('reservations', 'reservations_meeting_rooms.r_fk_id = reservations.r_id')
            ->where('reservations_meeting_rooms.mr_fk_number', $meetingRoomNum);
        return $builder->get()->getResult('App\Entities\Reservation');
    }

    /**
     * @param string $meetingRoomNum
     * @param string $startDate
     * @param string $endDate
     * @return bool
     */
    public function isMeetingRoomAvailable(string $meetingRoomNum, string $startDate, string $endDate): bool
    {
        $query = $this->db->table('reservations_meeting_rooms')
            ->join('reservations', 'reservations_meeting_rooms.r_fk_id = reservations.r_id')
            ->where('reservations_meeting_rooms.mr_number', $meetingRoomNum)
            ->groupStart()
                ->where("('$startDate' BETWEEN reservations.R_STARTING_DATE AND reservations.R_ENDING_DATE)")
                ->orWhere("('$endDate' BETWEEN reservations.R_STARTING_DATE AND reservations.R_ENDING_DATE)")
                ->orWhere("(reservations.R_STARTING_DATE BETWEEN '$startDate' AND '$endDate')")
            ->groupEnd()
            ->get();

        return $query->getNumRows() === 0;
    }
}
