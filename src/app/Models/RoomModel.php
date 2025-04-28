<?php

namespace App\Models;

use App\Entities\Reservation;
use App\Entities\Room;
use CodeIgniter\Model;
use Exception;

class RoomModel extends Model
{
    protected $table            = 'rooms';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = Room::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'room_number',
        'type',
        'description',
        'price',
        'available',
        'capacity',
        'img_url',
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';

    // Validation rules omitted for brevity...
    // Callbacks omitted for brevity...

    /**
     * @param int $roomId
     * @return Reservation[]|null
     */
    public function getReservationsByRoom(int $roomId): ?array
    {
        $query = $this->db->table('reservations_rooms')
            ->select('reservations.*')
            ->join('reservations', 'reservations.id = reservations_rooms.reservation_id')
            ->where('reservations_rooms.room_id', $roomId);

        $result = $query->get()->getResult(Reservation::class);

        return $result ?: null;
    }

    /**
     * Vérifie si une chambre est disponible aux dates demandées
     */
    public function isRoomAvailable(int $roomId, string $startDate, string $endDate): bool
    {
        $query = $this->db->table('reservations_rooms')
            ->join('reservations', 'reservations_rooms.reservation_id = reservations.id')
            ->where('reservations_rooms.room_id', $roomId)
            ->groupStart()
                // Date de début demandée tombe dans une réservation existante
                ->where("$startDate BETWEEN reservations.start_date AND reservations.end_date", null, false)
                // Date de fin demandée tombe dans une réservation existante
                ->orWhere("$endDate BETWEEN reservations.start_date AND reservations.end_date", null, false)
                // Réservation existante entièrement contenue dans la période demandée
                ->orWhere("reservations.start_date BETWEEN '$startDate' AND '$endDate'", null, false)
            ->groupEnd()
            ->get();

        return $query->getNumRows() === 0;
    }

    /**
     * @param string $startDate
     * @param string $endDate
     * @return Room[]|null
     */
    public function getAvailableRooms(string $startDate, string $endDate): ?array
    {
        $availableRooms = [];
        $rooms = $this->findAll();

        foreach ($rooms as $room) {
            // On passe l'ID (int) et non l'objet
            if ($this->isRoomAvailable($room->id, $startDate, $endDate)) {
                $availableRooms[] = $room;
            }
        }

        return $availableRooms ?: null;
    }

    /**
     * @param int $reservationId
     * @param int $roomId
     * @return bool
     * @throws Exception
     */
    public function addRoomToReservation(int $reservationId, int $roomId): bool
    {
        if (!$roomId || !$reservationId) {
            throw new Exception("Aucune chambre ou réservation fournie.");
        }

        $success = $this->db->table('reservations_rooms')
            ->insert([
                'reservation_id' => $reservationId,
                'room_id'        => $roomId,
            ]);

        if (! $success) {
            throw new Exception("Impossible d'ajouter la chambre à la réservation.");
        }

        return true;
    }

    /**
     * @return Room[]|null
     */
    public function getPopularRooms(int $limit = 5): ?array
    {
        return $this->select('rooms.*, COUNT(reservations_rooms.reservation_id) AS booking_count')
            ->join('reservations_rooms', 'reservations_rooms.room_id = rooms.id', 'left')
            ->groupBy('rooms.id')
            ->orderBy('booking_count', 'DESC')
            ->limit($limit)
            ->find() ?: null;
    }
}
