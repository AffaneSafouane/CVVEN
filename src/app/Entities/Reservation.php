<?php

namespace App\Entities;

use App\Enum\MealOption;
use App\Enum\ReservationStatus;
use App\Models\MeetingRoomModel;
use App\Models\RoomModel;
use CodeIgniter\Entity\Cast\DatetimeCast;
use CodeIgniter\Entity\Entity;
use CodeIgniter\I18n\Time;
use Exception;

/**
 * @property ?int $id
 * @property ?DatetimeCast $startingDate
 * @property ?DatetimeCast $endingDate
 * @property ?MealOption $mealOption
 * @property ?int $numberOfPeople
 * @property ?float $totalPrice
 * @property ?ReservationStatus $status
 * @property ?int $user
 */

class Reservation extends Entity
{
    protected $datamap = [
        'r_id' => 'id',
        'r_starting_date' => 'startingDate',
        'r_ending_date' => 'endingDate',
        'r_meal_option' => 'mealOption',
        'r_number_people' => 'numberOfPeople',
        'r_total_price' => 'totalPrice',
        'r_status' => 'status',
        'u_fk_id' => 'user',
    ];

    protected $dates   = ['r_created_at', 'r_updated_at', 'r_deleted_at', 'r_starting_date', 'r_ending_date'];

    protected $casts   = [
        'id'             => 'int',
        'startingDate'   => 'datetime',
        'endingDate'     => 'datetime',
        'mealOption'     => 'class[App\Enum\MealOption]',
        'numberOfPeople' => 'int',
        'totalPrice'     => 'float',
        'status'         => 'class[App\Enum\ReservationStatus]',
        'user'           => 'int',
    ];

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @throws Exception
     */
    public function getStartingDate(string $format = 'Y-m-d H:i:s'): ?string
    {
        $this->startingDate = $this->mutateDate($this->startingDate);

        $timezone = $this->timezone ?? app_timezone();

        $this->startingDate->setTimezone($timezone);

        return $this->startingDate->format($format);
    }

    /**
     * @throws Exception
     */
    public function getEndingDate(string $format = 'Y-m-d H:i:s'): ?string
    {
        $this->endingDate = $this->mutateDate($this->endingDate);

        $timezone = $this->timezone ?? app_timezone();

        $this->endingDate->setTimezone($timezone);

        return $this->endingDate->format($format);
    }

    public function getMealOption(): ?MealOption
    {
        return $this->mealOption;
    }

    public function getNumberOfPeople(): ?int
    {
        return $this->numberOfPeople;
    }

    public function getTotalPrice(): ?float
    {
        return $this->totalPrice;
    }

    public function getStatus(): ?ReservationStatus
    {
        return $this->status;
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

    /**
     * @throws Exception
     */
    public function setStartingDate(string $startingDate): static
    {
        $this->startingDate = new Time($startingDate, 'UTC');
        return $this;
    }

    /**
     * @throws Exception
     */
    public function setEndingDate(string $endingDate): static
    {
        $this->endingDate = new Time($endingDate, 'UTC');
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
