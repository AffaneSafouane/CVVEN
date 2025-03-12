<?php

namespace App\Entities;

use App\Models\ReservationModel;
use CodeIgniter\Entity\Entity;

/**
 * @property ?int $id
 * @property ?string $num
 * @property ?string $type
 * @property ?string $description
 * @property ?float $price
 * @property ?bool $available
 * @property ?int $capacity
 */

class Room extends Entity
{
    protected $datamap = [
        'id'             => 'id',
        'roomNumber'     => 'room_number',
        'type'           => 'type',
        'description'    => 'description',
        'price'          => 'price',
        'available'      => 'available',
        'capacity'       => 'capacity',
    ];

    protected $casts   = [
        'id'              => 'integer',
        'room_number'     => 'string',
        'type'            => 'string',
        'description'     => 'string',
        'price'           => 'float',
        'available'       => 'int-bool',
        'capacity'        => 'int',
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

    public function getRoomNumber(): ?string
    {
        return $this->num;
    }

    public function setRoomNumber(?string $num): static
    {
        $this->num = $num;
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

    /** 
     * @return ?Reservation[]
     */
    public function getReservations(): ?array
    {
        $reservationModel = new ReservationModel();
        $reservationModel->getReservationsByRoom($this->id);
    }
}
