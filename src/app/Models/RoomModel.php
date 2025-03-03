<?php

namespace App\Models;

use App\Entities\Room;
use CodeIgniter\Model;

class RoomModel extends Model
{
    protected $table            = 'rooms';
    protected $primaryKey       = 'ro_number';
    protected $useAutoIncrement = false;
    protected $returnType       = Room::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['ro_number', 'ro_type', 'ro_description', 'ro_price', 'ro_cleaning_option', 'ro_available', 'ro_capacity'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';

    // Validation
    protected $validationRules      = [
        'ro_number'          => 'required|is_unique[rooms.ro_number]|regex_match[/\A[0-9]+\z/]|min_length[3]|max_length[3]',
        'ro_type'            => 'required|regex_match[/^[a-zA-Zàâäéèêëîïôöùûüç\'\-]+$/]|min_length[3]|max_length[50]',
        'ro_description'     => 'required|min_length[10]|max_length[255]',
        'ro_price'           => 'decimal|greater_than[0]|less_than[500]|required',
        'ro_cleaning_option' => 'required|in_list[0,1]',
        'ro_available'       => 'required|in_list[0,1]',
        'ro_capacity'        => 'required|integer|greater_than[0]|less_than[10]'
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
        return $this->where('r_fk_id', $reservationId)->findAll();
    }

    /**
     * @param string $roomNum
     * @param string $startDate
     * @param string $endDate
     * @return bool
     */
    public function isRoomAvailable(string $roomNum, string $startDate, string $endDate): bool
    {
        // @TODO Vérifier si la chambre est disponible aux dates demandées (cf. MeetingRoomModel)
    }

    // SELECT COUNT(ro_type) AS RoomType FROM `rooms` WHERE ro_type = "Logements";
    // SELECT COUNT(ro_type) AS RoomType FROM `rooms` WHERE ro_type = "Chambre double";
    // SELECT COUNT(ro_type) AS RoomType FROM `rooms` WHERE ro_type = "Chambre triple";
    // SELECT COUNT(ro_type) AS RoomType FROM `rooms` WHERE ro_type = "Chambre quadruple";
}
