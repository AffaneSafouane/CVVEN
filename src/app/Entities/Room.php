<?php

namespace App\Entities;

use App\Models\ReservationModel;
use App\Models\RoomModel;
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

    /** 
     * @return ?Reservation[]
     */
    public function getReservations(): ?array
    {
        $roomModel = new RoomModel();
        $roomModel->getReservationsByRoom($this->id);
    }
}
