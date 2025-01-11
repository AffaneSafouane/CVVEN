<?php

namespace App\Entities;

use App\Enum\MealOption;
use App\Enum\ReservationStatus;
use App\Models\MeetingRoomModel;
use App\Models\RoomModel;
use CodeIgniter\Entity\Entity;
use CodeIgniter\I18n\Time;
use Exception;

class Reservation extends Entity
{
    protected $attributes = [
        'r_id' => null,
        'r_starting_date' => null,
        'r_ending_date' => null,
        'r_meal_option' => null,
        'r_number_people' => null,
        'r_total_price' => null,
        'r_status' => null,
        'u_fk_id' => null,
    ];

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

    /** @var list<string>  */
    protected $dates   = ['r_created_at', 'r_updated_at', 'r_deleted_at'];

    /**
     * @var array<string, string>
     */
    protected $casts   = [
        'id'  => 'int',
        'startingDate'   => 'datetime',
        'endingDate'     => 'datetime',
        'mealOption'     => 'class[App\Enum\MealOption]',
        'numberOfPeople' => 'int',
        'totalPrice'     => 'float',
        'status'         => 'class[App\Enum\ReservationStatus]',
        'user'           => 'class[CodeIgniter\Shield\Entities\User]',
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

    public function getRoom(): ?array
    {
        $roomModel = new RoomModel();
        return $roomModel->find($this->id);
    }

    public function getMeetingRoom(): ?array
    {
        $meetingRoomModel = new MeetingRoomModel();
        return $meetingRoomModel->find($this->id);
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
