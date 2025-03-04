<?php

namespace App\Services\Reservation;

use App\Enum\MealOption;
use App\Enum\ReservationType;
use Exception;

/**
 * @property ?string $startingDate
 * @property ?string $endingDate
 * @property ?int $nbPeople
 * @property ?MealOption $mealOption
 * @property ?ReservationType $type
 * @property int|string|null $id
 * @property string $status
 */
abstract class BaseReservation
{
    protected ?string $startingDate;
    protected ?string $endingDate;
    protected ?int $nbPeople;
    protected ?string $mealOption;
    protected ?string $type;
    protected int|string|null $id;
    protected ?int $userId;
    protected string $status;

    public function __construct(array $data)
    {
        $this->startingDate = $data['startingDate'] ?? null;
        $this->endingDate = $data['endingDate'] ?? null;
        $this->nbPeople = $data['nbPeople'] ?? null;
        $this->mealOption = $data['mealOption'] ?? null;
        $this->type = $data['type'] ?? null;
        $this->id = $data['id'] ?? null;
        $this->userId = $data['userId'] ?? null;
        $this->status = 'En attente';
    }

    /**
     * @throws Exception
     */
    protected function validateBase(): bool
    {
        $validation = service('validation');

        $validation->setRules([
            'startingDate' => 'required|valid_date|isValidDateRange[endingDate]',
            'endingDate' => 'required|valid_date',
            'nbPeople' => 'required|integer|greater_than[0]|less_than[201]',
            'mealOption' => 'required|in_list[Pension-Compléte,Demi-Pension,Sans-Pension]',
            'type' => 'required|in_list[Chambre,Salle de réunion,Activité]',
            'userId' => 'required|integer|greater_than[0]',
            'id' => 'required|regex_match[/\A[0-9]+\z/]|min_length[1]|max_length[3]',
        ]);

        $dataToValidate = [
            'startingDate' => $this->startingDate,
            'endingDate' => $this->endingDate,
            'nbPeople' => $this->nbPeople,
            'mealOption' => $this->mealOption,
            'type' => $this->type,
            'id' => $this->id,
            'userId' => $this->userId,
        ];

        if (!$validation->run($dataToValidate)) {
            throw new Exception(implode("<br>", $validation->getErrors()));
        }

        return true;
    }

    abstract public function validate(): bool;

    public function getId(): string|int|null
    {
        return $this->id;
    }

    public function getData(): array
    {
        return [
            'startingDate'   => $this->startingDate,
            'endingDate'     => $this->endingDate,
            'numberOfPeople' => $this->nbPeople,
            'mealOption'     => $this->mealOption,
            'type'           => $this->type,
            'status'         => $this->status,
            'userId'         => $this->userId,
        ];
    }
}