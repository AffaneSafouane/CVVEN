<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Description of ClientsModel
 *
 * @author cif
 */
class ClientsModel extends Model {
    protected $table = 'clients';

    protected $allowedFields = ['nom_client', 'prenom_client', 'email_client', 'password_client', "telephone_client", "admin"];

    /**
     * @param bool|int $client_id
     *
     * @return array|null
     */
    public function getClients(bool|int $client_id = false): ?array
    {
        if ($client_id === false) {
            return $this->findAll();
        }

        return $this->where(['id_client' => $client_id])->first();
    }
}
