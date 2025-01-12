<?php

namespace App\Entities;

use App\Models\ReservationModel;
use CodeIgniter\Entity\Entity;

/**
 * @property ?int $id
 * @property ?string $type
 * @property ?string $description
 * @property ?float $price
 * @property ?bool $cleaningOption
 * @property ?bool $available
 * @property ?int $reservation
 */

class Room extends Entity
{
    protected $datamap = [
        'id'             => 'ro_number',
        'type'           => 'ro_type',
        'description'    => 'ro_description',
        'price'          => 'ro_price',
        'cleaningOption' => 'ro_cleaning_option',
        'available'      => 'ro_available',
        'reservation'    => 'r_fk_id',
    ];

    protected $casts   = [
        'ro_number'          => 'int',
        'ro_type'            => 'string',
        'ro_description'     => 'string',
        'ro_price'           => 'float',
        'ro_cleaning_option' => '?int-bool',
        'ro_available'       => 'int-bool',
        'r_fk_id'            => '?int',
    ];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): static
    {
        $this->id = $id;
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

    public function getReservation(): array|Reservation|null
    {
        $reservationModel = new ReservationModel();
        return $reservationModel->find($this->reservation);
    }

    public function setReservation(?int $reservation): static
    {
        $this->reservation = $reservation;
        return $this;
    }
}
