<?php

namespace App\Entities;

use App\Models\ReservationModel;
use CodeIgniter\Entity\Entity;

/**
 * @property ?int $id
 * @property ?string $type
 * @property ?string $description
 * @property ?int $capacity
 * @property ?float $price
 * @property ?bool $available
 * @property ?int $reservation
 */

class MeetingRoom extends Entity
{
    protected $datamap = [
        'id' => 'mr_number',
        'type' => 'mr_type',
        'description' => 'mr_description',
        'capacity' => 'mr_capacity',
        'price' => 'mr_price',
        'available' => 'mr_available',
        'reservation' => 'r_fk_id',
    ];

    protected $casts   = [
        'id' => 'integer',
        'type' => 'string',
        'description' => 'string',
        'capacity' => 'integer',
        'price' => 'integer',
        'available' => 'int-bool',
        'reservation' => 'int',
    ];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getCapacity(): ?int
    {
        return $this->capacity;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function getAvailable(): ?bool
    {
        return $this->available;
    }

    public function getReservation(): array|Reservation|null
    {
        $reservationModel = new ReservationModel();
        return $reservationModel->find($this->reservation);
    }

    public function setId(int $id): static
    {
        $this->id = $id;
        return $this;
    }

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

    public function setCapacity(int $capacity): static
    {
        $this->capacity = $capacity;
        return $this;
    }

    public function setPrice(bool $price): static
    {
        $this->price = $price;
        return $this;
    }

    public function setAvailable(bool $available): static
    {
        $this->available = $available;
        return $this;
    }

    public function setReservation(int $reservation): static
    {
        $this->reservation = $reservation;
        return $this;
    }
}
