<?php

namespace App\Models;

use App\Entities\Client;
use App\Entities\Reservation;
use App\Enum\FamilyQuotient;
use CodeIgniter\Entity\Entity;
use CodeIgniter\Model;
use CodeIgniter\Shield\Entities\User;

class ClientModel extends Model
{
    protected $table            = 'clients';
    protected $primaryKey       = 'client_id';
    protected $useAutoIncrement = false;
    protected $returnType       = Client::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['client_id', 'phone', 'address', 'city', 'postal_code', 'family_quotient', 'birth_date'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = '';
    protected $updatedField  = '';
    protected $deletedField  = '';

    // Validation
    protected $validationRules      = [
        'client_id'       => 'required|is_natural_no_zero|is_unique[clients.client_id]',
        'family_quotient' => 'required|in_list[less_800,800-1200,1200-1800,1800-2500,more_2500]',
        'phone'           => 'permit_empty|min_length[10]|max_length[10]|regex_match[/\A[0-9]+\z/]|is_unique[clients.phone]',
        'address'         => 'required|min_length[5]|max_length[200]',
        'city'            => 'required|min_length[1]|max_length[150]',
        'postal_code'     => 'required|min_length[5]|max_length[5]|regex_match[/\A[0-9]+\z/]',
        'birth_date'      => 'required|valid_date',
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

    public function getFamilyQuotaDiscount(FamilyQuotient $familyQuotient): float
    {
        // Calculer le pourcentage de réduction à partir du quotient familial
        return match ($familyQuotient) {
            FamilyQuotient::LESS_800 => 0.4,
            FamilyQuotient::BETWEEN_800_1200 => 0.3,
            FamilyQuotient::BETWEEN_1200_1800 => 0.2,
            FamilyQuotient::BETWEEN_1800_2500 => 0.1,
            FamilyQuotient::MORE_2500 => 1,
        };
    }
}
