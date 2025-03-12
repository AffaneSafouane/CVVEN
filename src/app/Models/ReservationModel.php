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
        // récupérer les réservations d'une chambre via la table jointe reservations_rooms
        $query = $this->db('reservations_rooms')
            ->join('reservations', 'reservations.id = reservations_rooms.reservation_id')
            ->where('reservations.room_id', $roomId);
        return $query->get()->getResult('App\Entities\Reservation');
    }

    private function getFamilyQuotaDiscount(FamilyQuotient $familyQuotient): float
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

    private function getPensionExtra(PensionType $pensionType): int
    {
        // Calculer l'extra du type de pension
        return match ($pensionType) {
            PensionType::FullPension => 50,
            PensionType::HalfPension => 30,
            PensionType::NoPension => 0,
        };
    }

    /**
     * @param Reservation $reservation
     * @param Room $room
     * @return float
     */
    private function calculatePrice(Room $room, Reservation $reservation): float
    {
        // Prix de base = prix de la chambre * 7 (nb de nuits)
        $basePrice = $room->price * 7;

        // Supplément pour pension
        $pensionExtra = $basePrice + $this->getPensionExtra($reservation->pension);

        // Supplément +30 pour option ménage
        $cleaningFee = $reservation->cleaningOption ? 30 : 0;

        // Réduction en fonction du quotient familial
        $discountRate = $this->getFamilyQuotaDiscount($reservation->familyQuotient);
        $discount = $basePrice * $discountRate;

        // Calculer et retourner le prix total de la réservation
        return ($basePrice + $pensionExtra + $cleaningFee) - $discount;
    }

    /**
     * @param Reservation $reservation
     * @param int $roomId
     * @return bool
     * @throws Exception
     */
    private function saveReservation(Reservation $reservation, int $roomId): bool
    {
        // Vérifier si $roomId est null
        $roomModel = new RoomModel();

        // Si c'est le cas, lever une exception pour empêcher une opération invalide
        if (!$roomId) {
            throw new Exception('Aucune chambre n\'a été sélectionnée pour cette réservation.');
        }

        // Récupérer la chambre et vérifier si elle existe, lever une exception si ce n'est pas le cas
        $room = $roomModel->find($roomId)->getRow('\App\Entities\Room');
        if (!$room) {
            throw new Exception('Chambre non trouvé');
        }

        // Vérifier la disponibilité de la chambre pour les dates de la réservation
        if (!$roomModel->isRoomAvailable($roomId, $reservation->getStartDate(), $reservation->getEndDate())) {
            throw new Exception('La chambre que vous voulez réserver n\'est pas disponible aux dates demandées.');
        }

        // Calculer le prix de la réservation
        $reservation->totalPrice = $this->calculatePrice($room, $reservation);

        // Retourner l'enregistrement de la réservation dans la base de données
        return $this->save($reservation);
    }

    /**
     * @param Reservation $reservation
     * @param int $roomId
     * @return bool
     * @throws Exception
     */
    public function createReservation(Reservation $reservation, int $roomId): bool
    {
        // Créer une réservation et insérer le lien réservation-chambre dans leur table jointe
        // Démarrer une transaction pour garantir l'intégrité des données
        $this->db->transStart();

        try {
            // Sauvegarder la réservation et vérifier si elle est bien enregistrée
            $reservation = $this->saveReservation($reservation, $roomId);
            if (!$reservation) {
                // Si l'insertion échoue, lever une exception pour signaler l'échec
                throw new Exception(implode('<br>', $this->errors()));
            }

            // Récupérer l'identifiant de la réservation nouvellement créée
            $reservationId = $this->db->insertID();

            $roomModel = new RoomModel();
            // Associer la chambre à la réservation
            $room = $roomModel->addRoomToReservation($reservationId, $roomId);

            // Si l'insertion échoue, lever une exception pour signaler l'échec
            if (!$room) {
                throw new Exception(implode('<br>', $this->errors()));
            }

            // Si toutes les insertions réussissent, valider la transaction pour enregistrer les modifications
            $this->db->transCommit();
            // Retourner true pour indiquer que l'opération a réussi
            return true;
        } catch (Exception $e) {
            // En cas d'exception levé annuler toutes les modifications effectuées dans la transaction
            $this->db->transRollback();
            // Enregistre l'erreur dans les logs pour un suivi ultérieur.
            log_message('error', "Erreur lors de l'enregistrement de la réservation : " . $e->getMessage());
            return false;
        }
    }

    /**
     * @throws Exception
     */
    public function cancelReservation(int $reservationId): bool
    {
        // Update status de la réservation et la supprimer dans la table jointe (admin et utilisateur concerné)
        // Début d'une transaction pour garantir l'intégrité des données.
        $this->db->transStart();
        try {
            // Met à jour le statut de la réservation en "Annulée" dans la base de données.
            $status = $this->update($reservationId, ['status' => 'Annulée']);
            // Vérifier si la mise à jour a réussi
            if (!$status) {
                // Si ce n'est pas le cas, lève une exception avec les erreurs.
                throw new Exception(implode('<br>', $this->errors()));
            }

            // Supprime les entrées associées à cette réservation dans la table de liaison
            $reservation = $this->db->table('reservations_rooms')
                ->where('reservations.id', $reservationId)
                ->delete();

            // Vérifie si la suppression a bien été effectuée Sinon, lève une exception.
            if(!$reservation) {
                throw new Exception(implode('<br>', $this->errors()));
            }

            // Si toutes les opérations se sont bien déroulées, valide la transaction et retourne true.
            $this->db->transCommit();
            return true;
        } catch (Exception $exception) {
            // En cas d'erreur, annule toutes les modifications effectuées dans la transaction.
            $this->db->transRollback();
            // Enregistre l'erreur dans les logs pour un suivi ultérieur.
            log_message('error', "Erreur lors de l'annulation de la réservation : " . $exception->getMessage());
            // Retourne false pour indiquer que l'annulation a échoué.
            return false;
        }
    }

    /**
     * @throws \ReflectionException
     */
    public function confirmReservation(int $reservationId): bool
    {
        // Update status de la réservation (admin)
        return $this->update($reservationId, ['status' => 'Confirmée']);
    }
}
