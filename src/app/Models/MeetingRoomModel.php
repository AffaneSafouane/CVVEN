<?php

namespace App\Models;

use App\Entities\MeetingRoom;
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
        'mr_number' => 'required|integer|is_unique[meeting_rooms.mr_number]|greater_than[0]',
        'mr_type' => 'required|regex_match[/^[a-zA-Zàâäéèêëîïôöùûüç\'\-]+$/]|min_length[3]|max_length[50]',
        'mr_description' => 'required|min_length[10]|max_length[255]',
        'mr_capacity' => 'required|integer|greater_than[0]|less_than[200]',
        'mr_price' => 'required|decimal|greater_than[0]|less_than[1000]',
        'mr_available' => 'required|in_list[0,1]',
        'r_fk_id' => 'is_natural_no_zero'
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
     * @return MeetingRoom[]
     */
    public function getMeetingRoomsByReservation(int $reservationId): array
    {
        return $this->where('r_fk_id', $reservationId)->findAll();
    }
}
