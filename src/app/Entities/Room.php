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
 * @property ?string $imgUrl
 */

class Room extends Entity
{
    protected $datamap = [
        'id'             => 'id',
        'num'            => 'room_number',
        'type'           => 'type',
        'description'    => 'description',
        'price'          => 'price',
        'available'      => 'available',
        'capacity'       => 'capacity',
        'imgUrl'         => 'img_url',
    ];

    protected $casts   = [
        'id'              => 'integer',
        'room_number'     => 'string',
        'type'            => 'string',
        'description'     => 'string',
        'price'           => 'float',
        'available'       => 'int-bool',
        'capacity'        => 'int',
        'img_url'         => 'string',
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
