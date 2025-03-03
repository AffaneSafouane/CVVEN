<?php

namespace App\Services\Reservation;

use App\Services\Reservation\BaseReservation;
use App\Models\RoomModel;
use Exception;

/**
 * @property RoomModel $roomModel
 * @property ?bool $cleaningOption
 */
class RoomReservation extends BaseReservation
{
    //@TODO attributs privées
    public function __construct(array $data)
    {
        parent::__construct($data);
        //@TODO compléter constructeur
    }

    /**
     * @throws Exception
     */
    public function validate(): bool
    {
        //@TODO vérifier les infos d'une chambre en implémentant la méthode parent
    }
}