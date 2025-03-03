<?php

namespace App\Services\Reservation;

use App\Enum\MealOption;
use App\Enum\ReservationType;
use Exception;

abstract class BaseReservation
{
    protected ?string $startingDate;
    protected ?string $endingDate;
    protected ?int $nbPeople;
    protected ?MealOption $mealOption;
    protected ?ReservationType $type;
    protected null|int|string $id;
    protected string $status = 'En attente';

    public function __construct(array $data)
    {
        $this->startingDate = $data['startingDate'] ?? null;
        $this->endingDate = $data['endingDate'] ?? null;
        $this->nbPeople = $data['nbPeople'] ?? null;
        $this->mealOption = $data['mealOption'] ?? null;
        $this->type = $data['type'] ?? null;
        $this->id = $data['id'] ?? null;
    }

    /**
     * @throws Exception
     */
    protected function validateBase(): bool
    {
        if (!$this->startingDate || !$this->endingDate || !$this->nbPeople || !$this->mealOption || !$this->type || !$this->id) {
            throw new Exception("Données de réservation incomplètes");
        }

        if ($this->startingDate > $this->endingDate) {
            throw new Exception('La date de fin doit être postérieur ou égale à la date de début.');
        }

        return true;
    }

    abstract public function validate(): bool;

    public function getData(): array
    {
        return [
            'startingDate' => $this->startingDate,
            'endingDate'   => $this->endingDate,
            'nbPeople'     => $this->nbPeople,
            'mealOption'   => $this->mealOption,
            'type'         => $this->type,
            'status'       => $this->status,
            'id'           => $this->id,
        ];
    }
}