<?php

namespace App\Models;

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
    protected $allowedFields    = ['room_number', 'type', 'description', 'price', 'available', 'capacity'];

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
        'capacity'        => 'required|integer|greater_than[0]'
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
     * @return ?Room
     */
    public function getRoomByReservation(int $reservationId): ?array
    {
        // TODO récupérer la chambre d'une réservation via la table de liaison reservations_rooms

        $query = $this->db->table('reservations_rooms')
            ->join('rooms', 'rooms.id = reservations_rooms.room_id')
            ->where('reservations_rooms.reservation_id', $reservationId);
        return $query->get()->getRow('App\Entities\Room');
    }

    public function isRoomAvailable(int $roomId, string $startDate, string $endDate): bool
    {
        // Construire la requête pour rechercher des conflits de réservation

        // Joindre la table reservations_rooms avec reservations
        // pour vérifier si la chambre est déjà réservée dans cette période

        // Filtrer les enregistrements pour la chambre spécifiée

        // Début du groupement des conditions de chevauchement des dates
        // Vérifier si la date de début demandée est comprise dans une réservation existante

        // Vérifier si la date de fin demandée est comprise dans une réservation existante

        // Vérifier si la réservation existante est entièrement contenue dans la période demandée

        // Exécuter la requête

        // Si aucune réservation ne chevauche la période demandée, la chambre est disponible
    }

    /**
     * @param string $startDate
     * @param string $endDate
     * @return ?Room[]
     */
    public function getAvailableRooms(string $startDate, string $endDate): ?array
    {
        // TODO: Afficher toutes les chambres disponibles

        // Initialise un tableau vide pour stocker les chambres disponibles.

        // Récupère toutes les chambres disponibles à partir de la base de données.

        // Vérifie pour chaque chambre si elle est disponible pour la période donnée.

        // Si la chambre est disponible, l'ajoute au tableau des chambres disponibles.

        // Retourne le tableau des chambres disponibles.
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
        // Si c'est le cas, lever une exception pour empêcher une réservation sans chambre

        // Insérer la relation réservation-chambre dans la table reservations_rooms

        // Si l'insertion échoue, annuler immédiatement lever une exception pour indiquer que l'ajout de la chambre a échoué

        // Retourner true pour confirmer que l'ajout de la chambre à la réservation a réussi
    }

    // SELECT COUNT(type) AS RoomType FROM `rooms` WHERE type = "Logements";
    // SELECT COUNT(type) AS RoomType FROM `rooms` WHERE type = "Chambre Double";
    // SELECT COUNT(type) AS RoomType FROM `rooms` WHERE type = "Chambre Triple";
    // SELECT COUNT(type) AS RoomType FROM `rooms` WHERE type = "Chambre Quadruple";
}
