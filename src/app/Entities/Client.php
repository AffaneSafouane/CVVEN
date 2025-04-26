<?php

namespace App\Entities;

use App\Entities\Cast\EnumCast;
use App\Enum\FamilyQuotient;
use App\Models\ReservationModel;
use CodeIgniter\Entity\Entity;
use CodeIgniter\I18n\Time;
use Exception;

/**
 * @property ?int $clientId
 * @property ?string $phone
 * @property ?string $address
 * @property ?string $city
 * @property ?string $postalCode
 * @property ?FamilyQuotient $familyQuotient
 * @property ?Time $birthDate
 */
class Client extends Entity
{
    protected $datamap = [
        'clientId'       => 'client_id',
        'postalCode'     => 'postal_code',
        'familyQuotient' => 'family_quotient',
        'birthDate'      => 'birth_date',
    ];

    protected $casts   = [
        'client_id'      => 'int',
        'phone'          => 'string',
        'address'        => 'string',
        'city'           => 'string',
        'postal_code'    => 'string',
        'birth_date'     => 'datetime',
        'familyQuotient' => 'enum[App\Enum\FamilyQuotient]',
    ];

    protected $castHandlers = [
        'enum' => EnumCast::class,
    ];

    public function getFamilyQuotient(): ?string
    {
        return $this->familyQuotient->getLabel();
    }

    public function getBirthDate(string $format = 'd/m/Y'): ?string
    {
        // Convert to CodeIgniter\I18n\Time object
        $this->attributes['birth_date'] = $this->mutateDate($this->attributes['birth_date']);

        $timezone = $this->timezone ?? app_timezone();

        $this->attributes['birth_date']->setTimezone($timezone);

        return $this->attributes['birth_date']->format($format);
    }

    /** @return ?Reservation[] */
    public function getReservations(): ?array
    {
        $reservationModel = new ReservationModel();
        return $reservationModel->getClientReservations($this->clientId);
    }
}
