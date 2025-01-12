<?php

namespace App\Entities;

use App\Entities\Cast\EnumCast;
use App\Enum\MealOption;
use App\Enum\ReservationStatus;
use App\Models\MeetingRoomModel;
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
 * @property ?Time $createdAt
 * @property ?Time $updatedAt
 * @property ?Time $deletedAt
 * @property ?MealOption $mealOption
 * @property ?int $numberOfPeople
 * @property ?float $totalPrice
 * @property ?ReservationStatus $status
 * @property ?int $user
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
        'startingDate'   => 'r_starting_date',
        'endingDate'     => 'r_ending_date',
        'status'         => 'r_status',
        'user'           => 'u_fk_id',
    ];
    
    protected $dates = ['r_created_at', 'r_updated_at', 'r_deleted_at', 'r_starting_date', 'r_ending_date'];

    protected $casts   = [
        'r_id'              => 'int',
        'r_meal_option'     => 'enum[App\Enum\MealOption]',
        'r_number_people'   => 'int',
        'r_total_price'     => 'float',
        'r_status'          => 'enum[App\Enum\ReservationStatus]',
        'u_fk_id'           => 'int',
    ];

    protected $castHandlers = [
        'enum' => EnumCast::class,
    ];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartingDate(): ?string
    {
        $format = 'Y-m-d H:i:s';
        $date = $this->mutateDate($this->startingDate);

        $timezone = $this->timezone ?? app_timezone();
        $date->setTimezone($timezone);

        return $date->format($format);
    }

    public function getEndingDate(): ?string
    {
        $format = 'Y-m-d H:i:s';
        $date = $this->mutateDate($this->endingDate);

        $timezone = $this->timezone ?? app_timezone();
        $date->setTimezone($timezone);

        return $date->format($format);
    }

    public function getCreatedAt(): ?string
    {
        $format = 'Y-m-d H:i:s';
        $date = $this->mutateDate($this->createdAt);

        $timezone = $this->timezone ?? app_timezone();
        $date->setTimezone($timezone);

        return $date->format($format);
    }

    public function getUpdatedAt(): ?string
    {
        $format = 'Y-m-d H:i:s';
        $date = $this->mutateDate($this->updatedAt);

        $timezone = $this->timezone ?? app_timezone();
        $date->setTimezone($timezone);

        return $date->format($format);
    }

    public function getMealOption(): string
    {
        return $this->mealOption->getLabel();
    }

    public function getNumberOfPeople(): ?int
    {
        return $this->numberOfPeople;
    }

    public function getTotalPrice(): ?float
    {
        return $this->totalPrice;
    }

    public function getStatus(): ?string
    {
        return $this->status->getLabel();
    }

    public function getUser(): array|User|null
    {
        $userModel = new UserModel();
        return $userModel->find($this->user);
    }

    public function getRooms(): ?array
    {
        $roomModel = new RoomModel();
        return $roomModel->getRoomsByReservation($this->id);
    }

    public function getMeetingRooms(): ?array
    {
        $meetingRoomModel = new MeetingRoomModel();
        return $meetingRoomModel->getMeetingRoomsByReservation($this->id);
    }

    public function setStartingDate(string $startingDate): static
    {
        try {
            $this->startingDate = new Time($startingDate, 'UTC');
        } catch (Exception $e) {
            log_message('error', 'Invalid starting date provided: ' . $e->getMessage());

            $this->startingDate = null;
        }

        return $this;
    }

    public function setEndingDate(string $endingDate): static
    {
        try {
            $this->endingDate = new Time($endingDate, 'UTC');
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
}
