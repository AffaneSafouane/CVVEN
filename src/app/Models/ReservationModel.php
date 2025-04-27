<?php

namespace App\Models;

use App\Entities\Reservation;
use App\Entities\Room;
use App\Enum\FamilyQuotient;
use App\Enum\PensionType;
use App\Models\ClientModel;
use CodeIgniter\Model;
use CodeIgniter\Shield\Exceptions\UserNotFoundException;
use Exception;
use ReflectionException;

class ReservationModel extends Model
{
    protected $table            = 'reservations';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = Reservation::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'start_date',
        'end_date',
        'meal_option',
        'cleaning_option',
        'number_people',
        'total_price',
        'status',
        'client_id',
    ];

    protected bool $allowEmptyInserts = true;
    protected bool $updateOnlyChanged = true;

    protected array $casts        = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = '';

    // Validation
    protected $validationRules = [
        'start_date'      => 'required|valid_date',
        'end_date'        => 'required|valid_date',
        'meal_option'     => 'required|in_list[Pension-Compléte,Demi-Pension,Sans-Pension]',
        'number_people'   => 'required|integer|greater_than[0]|less_than[50]',
        'cleaning_option' => 'required|in_list[0,1]',
        'total_price'     => 'required|decimal|greater_than[0]|less_than[1000]',
        'status'          => 'required|in_list[Confirmée,En attente,Annulée]',
        'client_id'       => 'required|is_natural_no_zero',
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

    public function getRoomByReservation(int $reservationId): ?Room
    {
        return $this->db
            ->table('reservations_rooms')
            ->select('rooms.*')
            ->join('rooms', 'rooms.id = reservations_rooms.room_id')
            ->where('reservations_rooms.reservation_id', $reservationId)
            ->get()
            ->getCustomRowObject(0, Room::class) ?: null;
    }

    /**
     * @param int $clientId
     * @return ?Reservation[]
     */
    public function getClientReservations(int $clientId): ?array
    {
        return $this->where('client_id', $clientId)->findAll();
    }

    private function getPensionExtra(PensionType $pensionType): int
    {
        return match ($pensionType) {
            PensionType::FullPension => 50,
            PensionType::HalfPension => 30,
            PensionType::NoPension   => 0,
        };
    }

    /**
     * @param Room $room
     * @param Reservation $reservation
     * @param int $clientId
     * @return float
     * @throws Exception
     */
    private function calculatePrice(Room $room, Reservation $reservation, int $clientId): float
    {
        // Prix de base = prix de la chambre * 7 nuits
        $basePrice = $room->price * 7;

        // Extra pension selon l'enum (la propriété pension est déjà un PensionType)
        $pensionTypeEnum = $reservation->pension ?? PensionType::NoPension;
        $pensionExtra    = $this->getPensionExtra($pensionTypeEnum);

        // Option ménage
        $cleaningFee = $reservation->cleaningOption ? 30 : 0;

        // Réduction selon quotient familial
        $clientModel = new ClientModel();
        $client      = $clientModel->find($clientId);
        if (! $client) {
            throw new UserNotFoundException('Client introuvable');
        }

        $fqEnum       = FamilyQuotient::tryFrom($client->familyQuotient)
            ?? FamilyQuotient::LESS_800;
        $discountRate = $clientModel->getFamilyQuotaDiscount($fqEnum);
        $discount     = $basePrice * $discountRate;

        return ($basePrice + $pensionExtra + $cleaningFee) - $discount;
    }

    /**
     * @param Reservation $reservation
     * @param int $roomId
     * @param int $clientId
     * @return bool
     * @throws Exception
     */
    private function saveReservation(Reservation $reservation, int $roomId, int $clientId): bool
    {
        $roomModel = new RoomModel();
        $room      = $roomModel->find($roomId);
        if (! $room) {
            throw new Exception('Chambre non trouvée');
        }

        if (! $roomModel->isRoomAvailable($roomId, $reservation->getStartDate(), $reservation->getEndDate())) {
            throw new Exception('Chambre non disponible aux dates demandées.');
        }

        $reservation->totalPrice = $this->calculatePrice($room, $reservation, $clientId);

        if (! $this->save($reservation)) {
            throw new Exception(implode('<br>', $this->errors()));
        }

        return true;
    }

    /**
     * @param Reservation $reservation
     * @param int $roomId
     * @param int $clientId
     * @return bool
     * @throws Exception
     */
    public function createReservation(Reservation $reservation, int $roomId, int $clientId): bool
    {
        $this->db->transStart();

        try {
            $this->saveReservation($reservation, $roomId, $clientId);
            $reservationId = $this->db->insertID();
            (new RoomModel())->addRoomToReservation($reservationId, $roomId);
            $this->db->transCommit();
            return true;
        } catch (Exception $e) {
            $this->db->transRollback();
            log_message('error', 'Erreur réservation : ' . $e->getMessage());
            return false;
        }
    }

    public function cancelReservation(int $reservationId): bool
    {
        $this->db->transStart();
        try {
            if (! $this->update($reservationId, ['status' => 'Annulée'])) {
                throw new Exception(implode('<br>', $this->errors()));
            }
            $this->db
                ->table('reservations_rooms')
                ->where('reservation_id', $reservationId)
                ->delete();
            $this->db->transCommit();
            return true;
        } catch (Exception $e) {
            $this->db->transRollback();
            log_message('error', 'Erreur annulation : ' . $e->getMessage());
            return false;
        }
    }

    public function confirmReservation(int $reservationId): bool
    {
        return $this->update($reservationId, ['status' => 'Confirmée']);
    }

    /** @return ?Reservation[] */
    public function getUpcomingReservations(int $limit = 5): ?array
    {
        return $this->select('reservations.*, rooms.room_number AS room_num, users.last_name')
            ->join('reservations_rooms', 'reservations_rooms.reservation_id = reservations.id')
            ->join('rooms', 'rooms.id = reservations_rooms.room_id')
            ->join('users', 'users.id = reservations.client_id')
            ->where('start_date >=', date('Y-m-d'))
            ->orderBy('start_date', 'ASC')
            ->limit($limit)
            ->find();
    }
}
