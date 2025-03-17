<?php

namespace App\Controllers;

use App\Models\ClientModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\Shield\Exceptions\PermissionException;

/**
 * Description of UserController
 *
 * @author Affane Safouane, Ghouas Ilyes
 */
class UserController extends BaseController {
    public function show(int $clientId): string
    {
        if (auth()->id() != $clientId) {
            throw new PermissionException('Vous n\'avez pas le droit d\'accéder à cette page.');
        }

        $userModel = new UserModel();

        $data = [
            'user' => $userModel->find($clientId),
            'title' => "Informations client",
        ];

        return view('users/view', $data);
    }

    public function update(int $userId): RedirectResponse
    {
        // TODO: Mettre à jour l'utilisateur
    }

    public function delete(int $userId): RedirectResponse
    {
        // TODO: Supprimer l'utilisateur
    }
}
