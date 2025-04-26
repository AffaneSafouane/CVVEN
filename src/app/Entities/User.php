<?php

namespace App\Entities;

use App\Models\UserModel;
use CodeIgniter\I18n\Time;
use CodeIgniter\Shield\Entities\User as ShieldUserEntity;
use Exception;

/**
 * @property ?string $last_name
 * @property ?string $first_name
 * @property ?bool $active
 */
class User extends ShieldUserEntity
{
    public function getCreatedAt(string $format = 'd/m/Y - H:i:s'): ?string
    {
        // Convert to CodeIgniter\I18n\Time object
        $this->attributes['created_at'] = $this->mutateDate($this->attributes['created_at']);

        $timezone = $this->timezone ?? app_timezone();

        $this->attributes['created_at']->setTimezone($timezone);

        return $this->attributes['created_at']->format($format);
    }

    public function getUpdatedAt(string $format = 'd/m/Y - H:i:s'): ?string
    {
        // Convert to CodeIgniter\I18n\Time object
        $this->attributes['updated_at'] = $this->mutateDate($this->attributes['updated_at']);

        $timezone = $this->timezone ?? app_timezone();

        $this->attributes['updated_at']->setTimezone($timezone);

        return $this->attributes['updated_at']->format($format);
    }

    public function getClient(): ?Client
    {
        $userModel = new UserModel();
        return $userModel->getClient($this->id);
    }
}
