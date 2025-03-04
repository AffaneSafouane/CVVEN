<?php

namespace App\Services\Reservation;

use App\Libraries\BookingDateValidator;
use App\Models\MeetingRoomModel;
use App\Services\Reservation\BaseReservation;
use Exception;

class MeetingRoomReservation extends BaseReservation
{
    private MeetingRoomModel $meetingRoomModel;
    private int $price;

    public function __construct(array $data)
    {
        parent::__construct($data);
        $this->meetingRoomModel = new MeetingRoomModel();
    }

    /**
     * @throws Exception
     */
    public function validate(): bool
    {
        $this->validateBase();

        $meetingRoom = $this->meetingRoomModel->find($this->id);

        if (!$meetingRoom || !$this->meetingRoomModel->isMeetingRoomAvailable($this->id, $this->startingDate, $this->endingDate) || $meetingRoom->available == 0) {
            throw new Exception('La salle de réunion demandé n\'est pas disponible.');
        }

        if (!BookingDateValidator::isMeetingRoomDateValid($this->startingDate, $this->endingDate, $error)) {
            throw new Exception($error);
        }

        if (!$this->nbPeople > 0 && !$this->nbPeople <= $meetingRoom->capacity) {
            throw new Exception('Le nombre de personnes indiqués n\'est pas valide pour cette salle.');
        }

        return true;
    }

    public function getData(): array
    {
        $meetingRoom = $this->meetingRoomModel->find($this->id);
        return array_merge(parent::getData(), [
            'totalPrice' => $meetingRoom->price,
        ]);
    }
}