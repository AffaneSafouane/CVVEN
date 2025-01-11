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
    protected $allowedFields    = ['ro_number', 'ro_type', 'ro_description', 'ro_price', 'ro_cleaning_option', 'ro_available', 'r_fk_id'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';

    // Validation
    protected $validationRules      = [
        'ro_number' => 'regex_match[/\A[0-9]+\z/]|required|is_unique[rooms.ro_number]',
        'ro_type' => 'regex_match[/^[a-zA-Zàâäéèêëîïôöùûüç\'\-]+$/]|required|min_length[3]|max_length[50]',
        'ro_description' => 'required|min_length[10]|max_length[255]',
        'ro_price' => 'decimal|greater_than[0]|less_than[10000]|required',
        'ro_cleaning_option' => 'required|in_list[0,1]',
        'ro_available' => 'required|in_list[0,1]',
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
}
