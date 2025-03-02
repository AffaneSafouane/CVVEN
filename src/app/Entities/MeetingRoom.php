<?php

namespace App\Entities;

use App\Models\MeetingRoomModel;
use CodeIgniter\Entity\Entity;

/**
 * @property ?string $num
 * @property ?string $type
 * @property ?string $description
 * @property ?int $capacity
 * @property ?float $price
 * @property ?bool $available
 */

class MeetingRoom extends Entity
{
    protected $datamap = [
        'num'         => 'mr_number',
        'type'        => 'mr_type',
        'description' => 'mr_description',
        'capacity'    => 'mr_capacity',
        'price'       => 'mr_price',
        'available'   => 'mr_available',
    ];

    protected $casts   = [
        'mr_number'      => 'string',
        'mr_type'        => 'string',
        'mr_description' => 'string',
        'mr_capacity'    => 'integer',
        'mr_price'       => 'integer',
        'mr_available'   => 'int-bool',
    ];

    public function getNum(): ?string
    {
        return $this->num;
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

    public function getReservations(): array|Reservation|null
    {
        $meetingRoomModel = new MeetingRoomModel();
        return $meetingRoomModel->getReservationsByMeetingRoom($this->num);
    }

    public function setNum(string $num): static
    {
        $this->num = $num;
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
}
