<?php

namespace App\Entities;

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
        'startingDate' => 'r_starting_date',
        'endingDate'   => 'r_ending_date',
        'price'        => 'a_price',
    ];

    protected $dates   = ['r_starting_date', 'r_ending_date'];

    protected $casts   = [
        'a_id'          => 'integer',
        'a_name'        => 'string',
        'a_description' => 'string',
        'a_price'       => 'float',
    ];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;
        return $this;
    }

    public function getStartingDate(): ?string
    {
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

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;
        return $this;
    }
}
