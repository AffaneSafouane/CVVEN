<?php

declare(strict_types=1);

namespace App\Models;

use App\Entities\Client;
use App\Entities\User;
use CodeIgniter\Shield\Models\UserModel as ShieldUserModel;

class UserModel extends ShieldUserModel
{
    protected $returnType = User::class;

    protected function initialize(): void
    {
        parent::initialize();

        $this->allowedFields = [
            ...$this->allowedFields,
            'last_name',
            'first_name',
        ];
        $this->returnType = User::class;
    }

    public function getClient(int $userId): array|Client|null
    {
        $clientModel = new ClientModel();
        return $clientModel->find($userId);
    }
}
