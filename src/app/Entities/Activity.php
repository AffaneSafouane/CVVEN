<?php

namespace App\Entities;

use App\Models\ActivityModel;
use CodeIgniter\Entity\Entity;
use CodeIgniter\I18n\Time;
use Exception;

/**
 * @property ?int $id
 * @property ?string $name
 * @property ?string $description
 * @property ?Time $startingDate
 * @property ?Time $endingDate
 * @property ?float $price
 */

class Activity extends Entity
{
    protected $datamap = [
        'id'           => 'a_id',
        'name'         => 'a_name',
        'description'  => 'a_description',
        'startingDate' => 'a_starting_date',
        'endingDate'   => 'a_ending_date',
        'price'        => 'a_price',
    ];

    protected $dates   = ['a_starting_date', 'a_ending_date'];

    protected $casts   = [
        'a_id'          => 'integer',
        'a_name'        => 'string',
        'a_description' => 'string',
        'a_price'       => 'float',
    ];

    public function setName(string $name): static
    {
        $this->name = $name;
        return $this;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;
        return $this;
    }

    public function getStartingDate(): ?string
    {
        if (!isset($this->startingDate)) {
            return null;
        }

        $format = 'Y-m-d H:i:s';
        $date = $this->mutateDate($this->startingDate);

        $timezone = $this->timezone ?? app_timezone();
        $date->setTimezone($timezone);

        return $date->format($format);
    }

    public function setStartingDate(string $startingDate): static|string
    {
        try {
            $this->startingDate = new Time($startingDate, 'UTC');
        } catch (Exception $e) {
            log_message('error', 'Invalid starting date provided: ' . $e->getMessage());
            $this->startingDate = null;
        }

        return $this;
    }

    public function getEndingDate(): ?string
    {
        if (!isset($this->endingDate)) {
            return null;
        }

        $format = 'Y-m-d H:i:s';
        $date = $this->mutateDate($this->endingDate);

        $timezone = $this->timezone ?? app_timezone();
        $date->setTimezone($timezone);

        return $date->format($format);
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

    public function setPrice(float $price): static
    {
        $this->price = $price;
        return $this;
    }

    public function getReservations(): array|Reservation|null
    {
        $activityModel = new ActivityModel();
        return $activityModel->getReservationsByActivity($this->id);
    }
}
