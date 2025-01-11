<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use CodeIgniter\I18n\Time;
use Exception;

class Activity extends Entity
{
    protected $attributes = [
        'a_id' => null,
        'a_name' => null,
        'a_description' => null,
        'a_starting_date' => null,
        'a_ending_date' => null,
        'a_price' => null,
    ];

    /** @var array<string, string>  */
    protected $datamap = [
        'id' => 'a_id',
        'name' => 'a_name',
        'description' => 'a_description',
        'startingDate' => 'a_starting_date',
        'endingDate' => 'a_ending_date',
        'price' => 'a_price',
    ];

    /** @var list<string>  */
    protected $dates   = ['a_starting_date', 'a_ending_date'];

    /** @var array<string, string>  */
    protected $casts   = [
        'id'              => 'integer',
        'startingDate'    => 'datetime',
        'endingDate'      => 'datetime',
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
    public function setStartingDate(string $startingDate): static
    {
        $this->startingDate = new Time($startingDate, 'UTC');
        return $this;
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

    /**
     * @throws Exception
     */
    public function setEndingDate(string $endingDate): static
    {
        $this->endingDate = new Time($endingDate, 'UTC');
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
