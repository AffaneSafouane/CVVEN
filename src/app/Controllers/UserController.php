<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Shield\Exceptions\PermissionException;
use CodeIgniter\Shield\Exceptions\UserNotFoundException;

/**
 * Description of UsersController
 *
 * @author Affane Safouane, Sisakoun Matthew, Ghouas Ilyes, Krouch Kellyann
 */
class UserController extends BaseController {
    public function show(?int $userID): string
    {
        if (auth()->id() != $userID) {
            throw new PermissionException('Vous n\'avez pas le droit d\'accéder à cette page.');
        }

        $model = model(UserModel::class);

        $data = [
            'user' => $model->find($userID),
            'title' => "Informations utilisateur",
        ];

        if ($data['user'] === null) {
            throw new UserNotFoundException('Impossible de trouver l\'utilisateur');
        }

        return view('user/view', $data);
    }

    // @TODO Ajouter les méthodes update et delete uniquement pour l'utilisateur concerné
}
