<?php

namespace App\Models;

use App\Entities\Reservation;
use CodeIgniter\Model;

class ReservationModel extends Model
{
    protected $table            = 'reservations';
    protected $primaryKey       = 'r_id';
    protected $useAutoIncrement = true;
    protected $returnType       = Reservation::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['r_starting_date', 'r_ending_date', 'r_meal_option', 'r_number_people', 'r_total_price', 'r_created_at', 'r_updated_at', 'r_deleted_at', 'r_status', 'r_type'];

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
        'r_meal_option'   => 'required|regex_match[/^[a-zA-Zàâäéèêëîïôöùûüç\'\-]+$/]|max_length[20]|min_length[5]',
        'r_number_people' => 'required|integer|greater_than[0]|less_than[500]',
        'r_total_price'   => 'required|decimal|greater_than[0]|less_than[10000]',
        'r_status'        => 'required|regex_match[/^[a-zA-Zàâäéèêëîïôöùûüç\'\-]+$/]|max_length[20]|min_length[5]',
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
}
