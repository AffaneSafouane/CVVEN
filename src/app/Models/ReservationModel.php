<?php

namespace App\Models;

use App\Entities\Reservation;
use App\Entities\Room;
use App\Enum\PensionType;
use CodeIgniter\Model;
use Exception;
use http\Encoding\Stream\Deflate;
use ReflectionException;

class ReservationModel extends Model
{
    protected $table            = 'reservations';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = Reservation::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['start_date', 'end_date', 'meal_option', 'cleaning_option', 'number_people', 'total_price', 'status', 'user_id'];

    protected bool $allowEmptyInserts = true;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = '';

    // Validation
    protected $validationRules      = [
        'start_date'      => 'required|valid_date',
        'end_date'        => 'required|valid_date',
        'family_quotient' => 'required|integer|greater_than[0]|less_than[7]',
        'meal_option'     => 'required|in_list[Pension-Compléte,Demi-Pension,Sans-Pension]',
        'number_people'   => 'required|integer|greater_than[0]|less_than[50]',
        'cleaning_option' => 'required|in_list[0,1]',
        'total_price'     => 'required|decimal|greater_than[0]|less_than[1000]',
        'status'          => 'required|in_list[Confirmée,En attente,Annulée]',
        'user_id'         => 'required|integer|greater_than[0]',
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
    public function getUserReservations(int $userId): ?array
    {
        return $this->where('user_id', $userId)->findAll();
    }

    /**
     * @param int $roomId
     * @return ?Reservation[]
     */
    public function getReservationsByRoom(int $roomId): ?array
    {
        // TODO récupérer les réservations d'une chambre via la table de liaison reservations_rooms
    }

    /**
     * @param Reservation $reservation
     * @param Room[] $rooms
     * @return float
     */
    public function calculatePrice(array $rooms, Reservation $reservation): float
    {
        // TODO: Calculer le prix en fonction du type de pension, du forfait ménage, du nombre de chambres et leur prix ainsi que du quotient familial
    }

    /**
     * @param Reservation $reservation
     * @param int $roomId
     * @return bool
     * @throws Exception
     */
    public function saveReservation(Reservation $reservation, int $roomId): bool
    {
        // Vérifier si $roomId est null
        // Si c'est le cas, lever une exception pour empêcher une opération invalide

        // Vérifier la disponibilité de la chambre pour les dates de la réservation (RoomModel->isRoomAvailable())

        // Retourner l'enregistrement de la réservation dans la base de données
    }

    /**
     * @param Reservation $reservation
     * @param int $roomId
     * @return bool
     * @throws Exception
     */
    public function createReservation(Reservation $reservation, int $roomId): bool
    {
        // Démarrer une transaction pour garantir l'intégrité des données

        // Sauvegarder la réservation (saveReservation()) et vérifier si elle est bien enregistrée
        // Si l'insertion échoue, annuler la transaction pour éviter d'enregistrer des données partielles
        // Puis lever une exception pour signaler l'échec

        // Récupérer l'identifiant de la réservation nouvellement créée

        // Associer la chambre à la réservation (RoomModel->addRoomToReservation())
        // Si l'insertion échoue, annuler la transaction pour éviter d'enregistrer des données partielles
        // Puis lever une exception pour signaler l'échec

        // Si toutes les insertions réussissent, valider la transaction pour enregistrer les modifications

        // Retourner true pour indiquer que l'opération a réussi
    }

    public function cancelReservation(int $reservationId): bool
    {
        // TODO: Update status de la réservation et supprimer dans table jointe
    }

    public function confirmReservation(int $reservationId): bool
    {
        // TODO: Update status de la réservation (uniquement pour admin)
    }
}
