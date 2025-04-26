<?php

namespace App\Entities;

use App\Entities\Cast\EnumCast;
use App\Enum\PensionType;
use App\Enum\ReservationStatus;
use App\Models\ReservationModel;
use App\Models\UserModel;
use CodeIgniter\Entity\Entity;
use CodeIgniter\I18n\Time;
use Exception;

/**
 * @property ?int $id
 * @property ?Time $startDate
 * @property ?Time $endDate
 * @property ?Time $createdAt
 * @property ?Time $updatedAt
 * @property ?bool $cleaningOption
 * @property ?PensionType $pension
 * @property ?int $numberOfPeople
 * @property ?float $totalPrice
 * @property ?ReservationStatus $status
 * @property ?int $clientId
 */

class Reservation extends Entity
{
    protected $datamap = [
        'id'             => 'id',
        'pension'        => 'pension_type',
        'numberOfPeople' => 'number_people',
        'totalPrice'     => 'total_price',
        'createdAt'      => 'created_at',
        'updatedAt'      => 'updated_at',
        'startDate'      => 'start_date',
        'endDate'        => 'end_date',
        'cleaningOption' => 'cleaning_option',
        'status'         => 'status',
        'clientId'       => 'client_id',
    ];
    
    protected $dates = ['created_at', 'updated_at', 'start_date', 'end_date'];

    protected $casts   = [
        'id'              => 'int',
        'pension_type'    => 'enum[App\Enum\PensionType]',
        'number_people'   => 'int',
        'total_price'     => 'float',
        'status'          => 'enum[App\Enum\ReservationStatus]',
        'cleaning_option' => 'int-bool',
        'client_id'       => 'int',
    ];

    protected $castHandlers = [
        'enum' => EnumCast::class,
    ];

    public function getStartDate(): ?string
    {
        if (!$this->attributes["start_date"]) {
            return null;
        }

        $format = 'd/m/Y';
        try {
            $date = $this->mutateDate($this->attributes["start_date"]);
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
        if (!$this->attributes["end_date"]) {
            return null;
        }

        $format = 'd/m/Y';
        try {
            $date = $this->mutateDate($this->attributes["end_date"]);
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
        if (!$this->attributes["created_at"]) {
            return null;
        }
        $format = 'Y/m/d - H:i:s';
        try {
            $date = $this->mutateDate($this->attributes["created_at"]);
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
        if (!$this->attributes["updated_at"]) {
            return null;
        }
        $format = 'Y/m/d - H:i:s';
        try {
            $date = $this->mutateDate($this->attributes["updated_at"]);
            $timezone = $this->timezone ?? app_timezone();
            $date->setTimezone($timezone);
            return $date->format($format);
        } catch (Exception $e) {
            log_message('error', 'Error formatting ending date ' . $e->getMessage());
            return null;
        }
    }

    public function getUser(): User|array|null
    {
        $userModel = new UserModel();
        return $userModel->find($this->clientId);
    }

    public function getRoom(): ?Room
    {
        $reservationModel = new ReservationModel();
        return $reservationModel->getRoomByReservation($this->id);
    }

    /** @return ?Reservation[] */
    public function getReservationsByClient(): ?array
    {
        $reservationModel = new ReservationModel();
        return $reservationModel->getClientReservations($this->clientId);
    }
}
