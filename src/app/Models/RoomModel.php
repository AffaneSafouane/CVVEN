<?php

namespace App\Models;

use App\Entities\Reservation;
use App\Entities\Room;
use CodeIgniter\Model;
use Exception;
use ReflectionException;

class RoomModel extends Model
{
    protected $table            = 'rooms';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = Room::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['room_number', 'type', 'description', 'price', 'available', 'capacity', 'img_url'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';

    // Validation
    protected $validationRules      = [
        'room_number'     => 'required|is_unique[rooms.room_number]|regex_match[/^B[0-9]{3}$/]|min_length[4]|max_length[4]',
        'type'            => 'required|min_length[1]',
        'description'     => 'required|min_length[5]|max_length[255]',
        'price'           => 'decimal|greater_than[0]|required',
        'available'       => 'required|in_list[0,1]',
        'capacity'        => 'required|integer|greater_than[0]',
        'img_url'         => 'permit_empty|min_length[5]|max_length[50]',
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
     * @param int $roomId
     * @return ?Reservation[]
     */
    public function getReservationsByRoom(int $roomId): ?array
    {
        // récupérer les réservations d'une chambre via la table jointe reservations_rooms
        $query = $this->db('reservations_rooms')
            ->join('reservations', 'reservations.id = reservations_rooms.reservation_id')
            ->where('reservations.room_id', $roomId);
        return $query->get()->getResult('App\Entities\Reservation');
    }

    public function isRoomAvailable(int $roomId, string $startDate, string $endDate): bool
    {
        // Construire la requête pour rechercher des conflits de réservation
        $query = $this->db->table('reservations_rooms')
            // Joindre la table reservations_rooms avec reservations
            // pour vérifier si la chambre est déjà réservée dans cette période
            ->join('reservations', 'reservations_rooms.reservation_id = reservations.id')
            // Filtrer les enregistrements pour la chambre spécifiée
            ->where('reservations_rooms.room_id', $roomId)
            // Début du groupement des conditions de chevauchement des dates
            ->groupStart()
                // Vérifier si la date de début demandée est comprise dans une réservation existante
                ->where('?', $startDate . ' BETWEEN reservations.start_date AND reservations.end_date', false)
                // Vérifier si la date de fin demandée est comprise dans une réservation existante
                ->orWhere('?', $endDate . ' BETWEEN reservations.start_date AND reservations.end_date', false)
                // Vérifier si la réservation existante est entièrement contenue dans la période demandée
                ->orWhere("reservations.start_date BETWEEN ? AND ?", [$startDate, $endDate])
            ->groupEnd()
            // Exécuter la requête
            ->get();
        // Si aucune réservation ne chevauche la période demandée, la chambre est disponible

        return $query->getNumRows() === 0;
    }

    /**
     * @param string $startDate
     * @param string $endDate
     * @return ?Room[]
     */
    public function getAvailableRooms(string $startDate, string $endDate): ?array
    {
        // Initialise un tableau vide pour stocker les chambres disponibles.
        $availableRooms = [];
        // Récupère toutes les chambres disponibles à partir de la base de données.
        $rooms = $this->findAll();
        // Vérifie pour chaque chambre si elle est disponible pour la période donnée.
        foreach ($rooms as $room) {
            if ($this->isRoomAvailable($room, $startDate, $endDate)) {
                // Si la chambre est disponible, l'ajoute au tableau des chambres disponibles.
                $availableRooms[] = $room;
            }
        }
        // Retourne le tableau des chambres disponibles.
        return $availableRooms;
    }

    /**
     * @param int $reservationId
     * @param int $roomId
     * @return bool
     * @throws Exception
     */
    public function addRoomToReservation(int $reservationId, int $roomId): bool
    {
        // Vérifier si $roomId ou $reservationId sont null
        if (!$roomId || !$reservationId) {
            // Si c'est le cas, lever une exception pour empêcher une réservation sans chambre
            throw new Exception('Aucune chambre, ou réservation, n\'a été fournie pour la réservation.');
        }

        // Insérer la relation réservation-chambre dans la table reservations_rooms
        $success = $this->db->table('reservations_rooms')->insert(['reservation_id' => $reservationId, 'room_id' => $roomId]);

        // Si l'insertion échoue, annuler immédiatement lever une exception pour indiquer que l'ajout de la chambre a échoué
        if (!$success) {
            throw new Exception('Impossible d\'ajouter la chambre à la réservation.' );
        }

        // Retourner true pour confirmer que l'ajout de la chambre à la réservation a réussi
        return true;
    }

    // SELECT COUNT(type) AS RoomType FROM `rooms` WHERE type = "Logements";
    // SELECT COUNT(type) AS RoomType FROM `rooms` WHERE type = "Chambre Double";
    // SELECT COUNT(type) AS RoomType FROM `rooms` WHERE type = "Chambre Triple";
    // SELECT COUNT(type) AS RoomType FROM `rooms` WHERE type = "Chambre Quadruple";
}
