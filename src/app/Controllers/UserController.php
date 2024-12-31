<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\Shield\Exceptions\PermissionException;
use CodeIgniter\Shield\Exceptions\UserNotFoundException;

/**
 * Description of UsersController
 *
 * @author Affane Safouane, Sisakoun Matthew, Ghouas Ilyes, Krouch Kellyann
 */
class UserController extends BaseController {
    public function show(?int $user_id): string
    {
        if (auth()->id() != $user_id) {
            throw new PermissionException('Vous n\'avez pas le droit d\'accéder à cette page.');
        }

        $model = model(UserModel::class);

        $user = $model->findById($user_id);
        $data['user'] = $user->toArray();
        $data['user']['email'] = $user->getEmail();

        if ($data['user'] === null) {
            throw new UserNotFoundException('Impossible de trouver l\'utilisateur');
        }

        $data['title'] = "Informations utilisateur";

        return view('users/view', $data);
    }
}
