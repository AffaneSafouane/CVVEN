<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\Shield\Exceptions\PermissionException;
use CodeIgniter\Shield\Exceptions\UserNotFoundException;

/**
 * Description of UserController
 *
 * @author Affane Safouane, Ghouas Ilyes
 */
class UserController extends BaseController {
    public function show(int $userId): string
    {
        if (auth()->id() !== $userId) {
            throw new PermissionException('Vous n\'avez pas le droit d\'accéder à cette page.');
        }

        $model = model(UserModel::class);

        $data = [
            'user' => $model->find($userId),
            'title' => "Informations utilisateur",
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
