<?php

namespace App\Models;

use App\Entities\Activity;
use CodeIgniter\Model;

class ActivityModel extends Model
{
    protected $table            = 'activities';
    protected $primaryKey       = 'a_id';
    protected $useAutoIncrement = true;
    protected $returnType       = Activity::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['a_name', 'a_starting_date', 'a_ending_date', 'a_description', 'a_price'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';

    // Validation
    protected $validationRules      = [
        'a_starting_date' => 'required|valid_date',
        'a_ending_date'   => 'required|valid_date',
        'a_description'   => 'required|min_length[10]|max_length[255]',
        'a_price'         => 'required|decimal|greater_than[0]|less_than[1000]',
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
