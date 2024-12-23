<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use ReflectionException;

/**
 * Description of Users
 *
 * @author Affane Safouane, Sisakoun Matthew, Ghouas Ilyes, Krouch Kellyann
 */
class UserController extends BaseController {
    public function index(): string
    {
        // @TODO rendre accessible uniquement aux administrateurs
        $model = model(UserModel::class);

        $data = [
            'users' => $model->getUsers(null),
            'title'     => 'Liste des utilisateurs',
        ];

        return view('users/index', $data);
    }

    public function show(?int $user_id): string
    {
        // @TODO rendre accessible uniquement au client concerné
        $model = model(UserModel::class);

        $data['user'] = $model->getUsers($user_id);

        if ($data['user'] === null) {
            throw new PageNotFoundException('Impossible de trouver l\'utilisateur');
        }

        $data['title'] = "Informations utilisateur";

        return view('users/view', $data);
    }

    public function new(): string
    {
        helper('form');

        $data = ["title" => 'Créer un nouvel utilisateur'];
        return view('users/create', $data);
    }

    /**
     * @throws ReflectionException
     */
    public function create(): string
    {
        helper('form');

        $data = $this->request->getPost(['lastName', 'name', 'address', 'password', 'password_conf', 'phone', 'email']);

        // Checks whether the submitted data passed the validation rules.
        if (!$this->validateData($data, [
            'lastName' => 'required|trim|max_length[255]|min_length[3]',
            'name' => 'required|trim|max_length[255]|min_length[3]',
            'address'  => 'required|trim|max_length[255]|min_length[10]',
            'password'  => 'required|trim|matches[password_conf]|max_length[255]|min_length[6]',
            'password_conf' => 'trim|required|matches[password]',
            'phone'  => 'required|trim|is_unique[utilisateur.u_telephone]|max_length[10]|min_length[10]',
            "email" => "required|trim|valid_email|is_unique[utilisateur.u_email]|max_length[255]|min_length[10]",
        ])) {
            // The validation fails, so returns the form.
            return $this->new();
        }

        // Gets the validated data.
        $post = $this->validator->getValidated();

        $model = model(UserModel::class);

        $model->save([
            'u_nom' => $post['lastName'],
            'u_prenom' => $post['name'],
            'u_email' => $post['email'],
            'u_password' => password_hash($post['password'], PASSWORD_DEFAULT),
            'u_telephone' => $post['phone'],
            'u_adresse' => $post['address']
        ]);

        return view('users/success', ['title' => 'Créer un nouvel utilisateur']);
    }
}
