<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Users;

/**
 * Description of UsersModel
 *
 * @author Affane Safouane, Sisakoun Matthew, Ghouas Ilyes, Krouch Kellyann
 */
class UserModel extends Model {
    protected $table = 'utilisateur';
    protected $primaryKey = 'u_id';

    protected $allowedFields = ['u_nom', 'u_prenom', 'u_email', 'u_adresse', 'u_mot_de_passe', "u_telephone", "u_admin", "u_date_creation"];

    /**
     * @param ?int $user_id
     *
     * @return ?array
     */
    public function getUsers(?int $user_id): ?array
    {
        if (!$user_id) {
            return $this->findAll();
        }

        return $this->find($user_id);
    }
}
