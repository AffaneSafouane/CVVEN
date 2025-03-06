<?php

namespace App\Entities;

use App\Entities\Cast\EnumCast;
use App\Enum\PensionType;
use App\Enum\ReservationStatus;
use App\Models\ReservationModel;
use App\Models\RoomModel;
use App\Models\UserModel;
use CodeIgniter\Entity\Entity;
use CodeIgniter\I18n\Time;
use CodeIgniter\Shield\Entities\User;
use Exception;

/**
 * @property ?int $id
 * @property ?Time $startDate
 * @property ?Time $endDate
 * @property ?Time $createdAt
 * @property ?Time $updatedAt
 * @property ?bool $cleaningOption
 * @property ?PensionType $pension
 * @property ?int $familyQuotient
 * @property ?int $numberOfPeople
 * @property ?float $totalPrice
 * @property ?ReservationStatus $status
 * @property ?int $userId
 */

class Reservation extends Entity
{
    protected $datamap = [
        'id'             => 'id',
        'pension'        => 'pension',
        'numberOfPeople' => 'number_people',
        'totalPrice'     => 'total_price',
        'createdAt'      => 'created_at',
        'updatedAt'      => 'updated_at',
        'startDate'      => 'start_date',
        'endDate'        => 'end_date',
        'cleaningOption' => 'cleaning_option',
        'familyQuotient' => 'family_quotient',
        'status'         => 'status',
        'userId'         => 'user_id',
    ];
    
    protected $dates = ['created_at', 'updated_at', 'start_date', 'end_date'];

    protected $casts   = [
        'id'              => 'int',
        'meal_option'     => 'enum[App\Enum\PensionType]',
        'number_people'   => 'int',
        'total_price'     => 'float',
        'status'          => 'enum[App\Enum\ReservationStatus]',
        'cleaning_option' => 'int-bool',
        'family_quotient' => 'int',
        'user_id'         => 'int',
    ];

    protected $castHandlers = [
        'enum' => EnumCast::class,
    ];

    public function getStartDate(): ?string
    {
        if (!$this->startDate) {
            return null;
        }

        $format = 'd/m/Y';
        try {
            $date = $this->mutateDate($this->startDate);
            $timezone = $this->timezone ?? app_timezone();
            $date->setTimezone($timezone);
            return $date->format($format);
        } catch (Exception $e) {
            log_message('error', 'Error formatting ending date ' . $e->getMessage());
            return null;
        }
    }

    public function getEndDate(): ?string
    {
        if (!$this->endDate) {
            return null;
        }

        $format = 'd/m/Y';
        try {
            $date = $this->mutateDate($this->endDate);
            $timezone = $this->timezone ?? app_timezone();
            $date->setTimezone($timezone);
            return $date->format($format);
        } catch (Exception $e) {
            log_message('error', 'Error formatting ending date ' . $e->getMessage());
            return null;
        }
    }

    public function getCreatedAt(): ?string
    {
        if (!$this->createdAt) {
            return null;
        }
        $format = 'Y/m/d - H:i:s';
        try {
            $date = $this->mutateDate($this->createdAt);
            $timezone = $this->timezone ?? app_timezone();
            $date->setTimezone($timezone);
            return $date->format($format);
        } catch (Exception $e) {
            log_message('error', 'Error formatting starting date ' . $e->getMessage());
            return null;
        }
    }

    public function getUpdatedAt(): ?string
    {
        if (!$this->updatedAt) {
            return null;
        }
        $format = 'Y/m/d - H:i:s';
        try {
            $date = $this->mutateDate($this->updatedAt);
            $timezone = $this->timezone ?? app_timezone();
            $date->setTimezone($timezone);
            return $date->format($format);
        } catch (Exception $e) {
            log_message('error', 'Error formatting ending date ' . $e->getMessage());
            return null;
        }
    }

    public function getPensionType(): ?string
    {
        return $this->pension->getLabel();
    }

    public function getStatus(): ?string
    {
        return $this->status->getLabel();
    }

    public function getFamilyQuotient(): ?int
    {
        return $this->familyQuotient;
    }

    /**
     * @return array|User|null
     */
    public function getUser(): array|User|null
    {
        $userModel = new UserModel();
        return $userModel->find($this->userId);
    }

    /**
     * @return ?Room[]
     */
    public function getRooms(): ?array
    {
        // @TODO appel la méthode getRoomByReservation() de RoomModel pour afficher les chambres d'une réservation
    }

    /**
     * @param int $userId
     * @return ?Reservation[]
     */
    public function getReservationsByUser(int $userId): ?array
    {
        $reservationModel = new ReservationModel();
        return $reservationModel->where('user_id', $userId)->findAll();
    }

    public function setStartDate(?string $startDate): static
    {
        try {
            $this->startDate = new Time($startDate, 'Europe/Paris');
        } catch (Exception $e) {
            log_message('error', 'Invalid starting date provided: ' . $e->getMessage());
            $this->startDate = null;
        }

        return $this;
    }

    public function setEndingDate(?string $endingDate): static
    {
        try {
            $this->endDate = new Time($endingDate, 'Europe/Paris');
        } catch (Exception $e) {
            log_message('error', 'Invalid ending date provided: ' . $e->getMessage());
            $this->endDate = null;
        }

        return $this;
    }

    public function setPensionType(?PensionType $pension): static
    {
        $this->pension = $pension;
        return $this;
    }

    public function setNumberOfPeople(?int $numberOfPeople): static
    {
        $this->numberOfPeople = $numberOfPeople;
        return $this;
    }

    public function setTotalPrice(?float $totalPrice): static
    {
        $this->totalPrice = $totalPrice;
        return $this;
    }

    public function setStatus(?ReservationStatus $status): static
    {
        $this->status = $status;
        return $this;
    }

    public function setFamilyQuotient(?int $familyQuotient): static
    {
        $this->familyQuotient = $familyQuotient;
        return $this;
    }

    public function getCleaningOption(): ?bool
    {
        return $this->cleaningOption;
    }

    public function setCleaningOption(?bool $cleaningOption): static
    {
        $this->cleaningOption = $cleaningOption;
        return $this;
    }

    public function setUser(?int $userId): static
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * @param int $reservationId
     * @param string[] $roomsId
     */
    public function addRooms(int $reservationId, array $roomsId): void
    {
        // TODO appel la méthode addRoomsToReservation() de ReservationModel pour ajouter des chambres à une réservation
    }

    // Méthode pour calculer le prix total selon le type de pension, le quotient familial et le prix des chambres
    public function calculatePrice(array $room_id, string $pension, $forfait_menage)
    {
        // TODO: Ajouter la logique pour calculer le prix en fonction du logement, des dates et des options
    }
}
