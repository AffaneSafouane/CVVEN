<?php

namespace App\Entities;

use App\Models\ReservationModel;
use CodeIgniter\Entity\Entity;

/**
 * @property ?string $num
 * @property ?string $type
 * @property ?string $description
 * @property ?float $price
 * @property ?bool $cleaningOption
 * @property ?bool $available
 * @property ?int $capacity
 */

class Room extends Entity
{
    protected $datamap = [
        'num'            => 'ro_number',
        'type'           => 'ro_type',
        'description'    => 'ro_description',
        'price'          => 'ro_price',
        'cleaningOption' => 'ro_cleaning_option',
        'available'      => 'ro_available',
        'capacity'       => 'ro_capacity',
    ];

    protected $casts   = [
        'ro_number'          => 'string',
        'ro_type'            => 'string',
        'ro_description'     => 'string',
        'ro_price'           => 'float',
        'ro_cleaning_option' => '?int-bool',
        'ro_available'       => 'int-bool',
        'ro_capacity'        => 'int',
    ];

    public function getNum(): ?string
    {
        return $this->num;
    }

    public function setNum(?string $num): static
    {
        $this->num = $num;
        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): static
    {
        $this->type = $type;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;
        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): static
    {
        $this->price = $price;
        return $this;
    }

    public function getCleaningOption(): ?bool
    {
        return $this->cleaningOption;
    }

    public function setCleaningOption(?bool $cleaningOption): static
    {
        $this->cleaningOption = $cleaningOption;
        return $this;
    }

    public function getAvailable(): ?bool
    {
        return $this->available;
    }

    public function setAvailable(?bool $available): static
    {
        $this->available = $available;
        return $this;
    }

    public function getCapacity(): ?int
    {
        return $this->capacity;
    }

    public function setCapacity(?int $capacity): static
    {
        $this->capacity = $capacity;
        return $this;
    }

    public function getReservation(): array|Reservation|null
    {
        // @TODO Récupérer les réservations d'une chambre
    }
}
