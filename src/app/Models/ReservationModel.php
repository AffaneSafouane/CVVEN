<?php

namespace App\Models;

use App\Entities\Reservation;
use App\Entities\Room;
use App\Enum\FamilyQuotient;
use App\Enum\PensionType;
use CodeIgniter\Model;
use Exception;

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
        'family_quotient' => 'required|in_list[less_800,800-1200,1200-1800,1800-2500,more_2500]',
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
        // TODO récupérer les réservations d'une chambre via la table jointe reservations_rooms
    }

    private function getFamilyQuotaDiscount(FamilyQuotient $familyQuotient): float
    {
        // TODO: Calculer le pourcentage de réduction à partir du quotient familial
        // match expression (enum)
        // QF < 800 = -40%
        // 800 ≤ QF < 1200 = -30%
        // 1200 ≤ QF < 1800 = -20%
        // 1800 ≤ QF < 2500 = -10%
        // < 2500 = pas de réduction
    }

    private function getPensionExtra(PensionType $pensionType): int
    {
        // TODO: Calculer l'extra du type de pension
        // match expression (enum)
        // Demi-pension = +30
        // Pension compléte = +50
        // Sans pension = +0
    }

    /**
     * @param Reservation $reservation
     * @param Room $room
     * @return float
     */
    private function calculatePrice(Room $room, Reservation $reservation): float
    {
        // TODO: Calculer le prix en fonction du type de pension, du forfait ménage, du prix de la chambre et du quotient familial
        // Prix de base, prix de la chambre * 7 (nb de nuits)

        // Supplément pour pension ($this->getPensionExtra)

        // Supplément +30 pour option ménage (if)

        // Réduction en fonction du quotient familial ($this->getFamilyQuotaDiscount)

        // Calculer et retourner le prix total (tout additionner moins la réduction)
    }

    /**
     * @param Reservation $reservation
     * @param int $roomId
     * @return bool
     * @throws Exception
     */
    public function saveReservation(Reservation $reservation, int $roomId): bool
    {
        // TODO: Enregistrer la réservation en vérifiant la disponibilité et établir le prix

        // Vérifier si $roomId est null
        // Si c'est le cas, lever une exception pour empêcher une opération invalide

        // Récupérer la chambre et vérifier si elle existe, lever une exception si ce n'est pas le cas

        // Vérifier la disponibilité de la chambre pour les dates de la réservation (RoomModel->isRoomAvailable())

        // Calculer le prix de la réservation ($this->calculatePrice())

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
        // TODO: Créer une réservation et insérer le lien réservation chambre dans leur table jointe
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

    /**
     * @throws Exception
     */
    public function cancelReservation(int $reservationId): bool
    {
        // TODO: Update status de la réservation et supprimer dans table jointe (admin et utilisateur concerné)
        // Début d'une transaction pour garantir l'intégrité des données.

        // Met à jour le statut de la réservation en "Annulée" dans la base de données.

        // Vérifie si la mise à jour a réussi. Si ce n'est pas le cas, lève une exception avec les erreurs.

        // Supprime les entrées associées à cette réservation dans la table de liaison (ex: réservations et chambres).

        // Vérifie si la suppression a bien été effectuée. Sinon, lève une exception.

        // Si toutes les opérations se sont bien déroulées, valide la transaction et retourne true.

        // En cas d'erreur, annule toutes les modifications effectuées dans la transaction.

        // Enregistre l'erreur dans les logs pour un suivi ultérieur.

        // Retourne false pour indiquer que l'annulation a échoué.
    }

    public function confirmReservation(int $reservationId): bool
    {
        // TODO: Update status de la réservation (admin)
    }
}
