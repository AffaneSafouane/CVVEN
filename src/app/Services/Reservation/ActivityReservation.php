<?php

namespace App\Services\Reservation;

use App\Models\ActivityModel;
use App\Services\Reservation\BaseReservation;

/**
 * @property ActivityModel $activityModel
 */
class ActivityReservation extends BaseReservation
{
    // @TODO modifier les dates de début et de fin de BaseReservation avec les dates de l'objet Activity
    public function validate(): bool
    {
        // TODO: Implement validate() method.
    }
}