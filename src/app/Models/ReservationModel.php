<?php

namespace App\Models;

use App\Entities\Activity;
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
    protected $allowedFields    = ['r_id', 'r_starting_date', 'r_ending_date', 'r_meal_option', 'r_number_people', 'r_total_price', 'r_created_at', 'r_updated_at', 'r_deleted_at', 'r_status', 'r_type', 'u_fk_id'];

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
        'r_type'          => 'required|in_list[Room, Activity, Meeting Room, Transport]',
        'r_meal_option'   => 'required|in_list[Full Pension, Half Pension, No Pension]',
        'r_number_people' => 'required|integer|greater_than[0]|less_than[500]',
        'r_total_price'   => 'required|decimal|greater_than[0]|less_than[1000]',
        'r_status'        => 'required|in_list[Confirmed, Pending, Canceled]',
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
     * @param int $userId
     * @return ?Reservation[]
     */
    public function getReservationByUser(int $userId): ?array
    {
        return $this->where('u_fk_id', $userId)->findAll();
    }

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

    /**
     * @param int $reservationId
     * @param int[] $activitiesId
     */
    public function addActivitiesToReservation(int $reservationId, array $activitiesId): void
    {
        $this->db->transStart();

        foreach ($activitiesId as $activityId) {
            $this->db->table('reservations_activities')->insert([
                'r_fk_id' => $reservationId,
                'a_fk_id' => $activityId
            ]);
        }

        $this->db->transComplete();

        if ($this->db->transStatus() === false) {
            throw new \RuntimeException('Failed to add activities to reservation');
        }
    }
}
