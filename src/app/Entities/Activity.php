<?php

namespace App\Entities;

use App\Models\ActivityModel;
use CodeIgniter\Entity\Entity;
use CodeIgniter\I18n\Time;
use Exception;

/**
 * @property ?int $id
 * @property ?string $type
 * @property ?string $description
 * @property ?Time $startingDate
 * @property ?Time $endingDate
 * @property ?float $price
 * @property ?int $limit
 */

class Activity extends Entity
{
    protected $datamap = [
        'id'           => 'a_id',
        'type'         => 'a_type',
        'description'  => 'a_description',
        'startingDate' => 'a_starting_date',
        'endingDate'   => 'a_ending_date',
        'price'        => 'a_price',
        'limit'        => 'a_limit',
    ];

    protected $dates   = ['a_starting_date', 'a_ending_date'];

    protected $casts   = [
        'a_id'          => 'integer',
        'a_type'        => 'string',
        'a_description' => 'string',
        'a_price'       => 'float',
        'a_limit'       => 'integer',
    ];

    public function setType(string $type): static
    {
        $this->type = $type;
        return $this;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;
        return $this;
    }

    public function getStartingDate(): ?string
    {
        if (!$this->startingDate) {
            return null;
        }
        $format = 'Y/m/d - H:i:s';
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

    public function setStartingDate(string $startingDate): static|string
    {
        try {
            $this->startingDate = new Time($startingDate, 'Europe/Paris');
        } catch (Exception $e) {
            log_message('error', 'Invalid starting date provided: ' . $e->getMessage());
            $this->startingDate = null;
        }

        return $this;
    }

    public function getEndingDate(): ?string
    {
        if (!$this->endingDate) {
            return null;
        }
        $format = 'Y/m/d - H:i:s';
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

    public function setPrice(float $price): static
    {
        $this->price = $price;
        return $this;
    }

    public function setLimit(int $limit): static
    {
        $this->limit = $limit;
        return $this;
    }

    public function getReservations(): array|Reservation|null
    {
        $activityModel = new ActivityModel();
        return $activityModel->getReservationsByActivity($this->id);
    }
}
