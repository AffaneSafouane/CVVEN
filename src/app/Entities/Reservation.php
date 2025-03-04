<?php

namespace App\Entities;

use App\Entities\Cast\EnumCast;
use App\Enum\MealOption;
use App\Enum\ReservationStatus;
use App\Enum\ReservationType;
use App\Models\MeetingRoomModel;
use App\Models\ReservationModel;
use App\Models\RoomModel;
use App\Models\UserModel;
use CodeIgniter\Entity\Entity;
use CodeIgniter\I18n\Time;
use CodeIgniter\Shield\Entities\User;
use Exception;

/**
 * @property ?int $id
 * @property ?Time $startingDate
 * @property ?Time $endingDate
 * @property ?ReservationType $type
 * @property ?Time $createdAt
 * @property ?Time $updatedAt
 * @property ?Time $deletedAt
 * @property ?MealOption $mealOption
 * @property ?int $numberOfPeople
 * @property ?float $totalPrice
 * @property ?ReservationStatus $status
 * @property ?int $userId
 */

class Reservation extends Entity
{
    protected $datamap = [
        'id'             => 'r_id',
        'mealOption'     => 'r_meal_option',
        'numberOfPeople' => 'r_number_people',
        'totalPrice'     => 'r_total_price',
        'createdAt'      => 'r_created_at',
        'updatedAt'      => 'r_updated_at',
        'deletedAt'      => 'r_deleted_at',
        'type'           => 'r_type',
        'startingDate'   => 'r_starting_date',
        'endingDate'     => 'r_ending_date',
        'status'         => 'r_status',
        'userId'         => 'u_fk_id',
    ];
    
    protected $dates = ['r_created_at', 'r_updated_at', 'r_deleted_at', 'r_starting_date', 'r_ending_date'];

    protected $casts   = [
        'r_id'              => 'int',
        'r_meal_option'     => 'enum[App\Enum\MealOption]',
        'r_number_people'   => 'int',
        'r_total_price'     => 'float',
        'r_status'          => 'enum[App\Enum\ReservationStatus]',
        'r_type'            => 'enum[App\Enum\ReservationType]',
        'u_fk_id'           => 'int',
    ];

    protected $castHandlers = [
        'enum' => EnumCast::class,
    ];

    public function getStartingDate(): ?string
    {
        if (!$this->startingDate) {
            return null;
        }
        $format = 'd/m/Y';
        try {
            $date = $this->mutateDate($this->startingDate);
            $timezone = $this->timezone ?? app_timezone();
            $date->setTimezone($timezone);
            return $date->format($format);
        } catch (Exception $e) {
            log_message('error', 'Error formatting ending date ' . $e->getMessage());
            return null;
        }
    }

    public function getEndingDate(): ?string
    {
        if (!$this->endingDate) {
            return null;
        }
        $format = 'd/m/Y';
        try {
            $date = $this->mutateDate($this->endingDate);
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

    public function getMealOption(): ?string
    {
        return $this->mealOption->getLabel();
    }

    public function getStatus(): ?string
    {
        return $this->status->getLabel();
    }

    public function getType(): ?string
    {
        return $this->type->getLabel();
    }

    /**
     * @return array|User|null
     */
    public function getUser(): array|User|null
    {
        $userModel = new UserModel();
        return $userModel->find($this->userId);
    }

    public function getRooms(): ?array
    {
        // @TODO appel la méthode du model de réservations pour afficher les chambres d'une réservation
    }

    public function getMeetingRooms(): ?array
    {
        $meetingRoomModel = new ReservationModel();
        return $meetingRoomModel->getMeetingRoomsByReservation($this->id);
    }

    public function getActivities(): ?array
    {
        $reservationModel = new ReservationModel();
        return $reservationModel->getActivitiesByReservation($this->id);
    }

    /**
     * @param int $userId
     * @return ?Reservation[]
     */
    public function getReservationsByUser(int $userId): ?array
    {
        $reservationModel = new ReservationModel();
        return $reservationModel->where('u_fk_id', $userId)->findAll();
    }

    public function setStartingDate(string $startingDate): static
    {
        try {
            $this->startingDate = new Time($startingDate, 'Europe/Paris');
        } catch (Exception $e) {
            log_message('error', 'Invalid starting date provided: ' . $e->getMessage());
            $this->startingDate = null;
        }

        return $this;
    }

    public function setEndingDate(string $endingDate): static
    {
        try {
            $this->endingDate = new Time($endingDate, 'Europe/Paris');
        } catch (Exception $e) {
            log_message('error', 'Invalid ending date provided: ' . $e->getMessage());
            $this->endingDate = null;
        }

        return $this;
    }

    public function setMealOption(MealOption $mealOption): static
    {
        $this->mealOption = $mealOption;
        return $this;
    }

    public function setNumberOfPeople(int $numberOfPeople): static
    {
        $this->numberOfPeople = $numberOfPeople;
        return $this;
    }

    public function setTotalPrice(float $totalPrice): static
    {
        $this->totalPrice = $totalPrice;
        return $this;
    }

    public function setStatus(ReservationStatus $status): static
    {
        $this->status = $status;
        return $this;
    }

    public function setUser(int $userId): static
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * @param int $reservationId
     * @param string[] $roomsNum
     */
    public function addRooms(int $reservationId, array $roomsNum): void
    {
        // @TODO appel la méthode addRoomsToReservation() de ReservationModel pour ajouter des chambres à une réservation
    }

    /**
     * @param int $reservationId
     * @param string[] $meetingRoomsNum
     */
    public function addMeetingRooms(int $reservationId, array $meetingRoomsNum): void
    {
        $reservationModel = new ReservationModel();
        $reservationModel->addMeetingRoomsToReservation($reservationId, $meetingRoomsNum);
    }

    /**
     * @param int $reservationId
     * @param int[] $activitiesId
     */
    public function addActivities(int $reservationId, array $activitiesId): void
    {
        $reservationModel = new ReservationModel();
        $reservationModel->addActivitiesToReservation($reservationId, $activitiesId);
    }
}
