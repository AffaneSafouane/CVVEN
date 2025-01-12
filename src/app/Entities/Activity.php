<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use CodeIgniter\I18n\Time;
use Exception;
use InvalidArgumentException;

/**
 * @property ?int $id
 * @property ?string $name
 * @property ?string $description
 * @property ?Time $r_starting_date
 * @property ?Time $r_ending_date
 * @property ?float $price
 */

class Activity extends Entity
{
    protected $datamap = [
        'id' => 'a_id',
        'name' => 'a_name',
        'description' => 'a_description',
        'price' => 'a_price',
    ];

    protected $dates   = ['r_starting_date', 'r_ending_date'];

    protected $casts   = [
        'id'              => 'integer',
        'name'            => 'string',
        'description'     => 'string',
        'price'           => 'float',
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
        try {
            return $this->r_starting_date->toDateTimeString();
        } catch (Exception $e) {
            log_message('error', 'Invalid starting date provided: ' . $e->getMessage());
        }

        return null;
    }

    public function setStartingDate(string $startingDate): static|string
    {
        try {
            $this->r_starting_date = new Time($startingDate, 'UTC');
        } catch (Exception $e) {
            log_message('error', 'Invalid starting date provided: ' . $e->getMessage());
            $this->r_starting_date = null;
        }

        return $this;
    }

    public function getEndingDate(): ?string
    {
        try {
            return $this->r_ending_date->toDateTimeString();
        } catch (Exception $e) {
            log_message('error', 'Invalid ending date provided: ' . $e->getMessage());
        }

        return null;
    }

    public function setEndingDate(string $endingDate): static
    {
        try {
            $this->r_ending_date = new Time($endingDate, 'UTC');
        } catch (Exception $e) {
            log_message('error', 'Invalid ending date provided: ' . $e->getMessage());
            $this->r_ending_date = null;
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
