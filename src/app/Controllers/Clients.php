<?php

namespace App\Controllers;

use App\Models\ClientsModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use ReflectionException;

/**
 * Description of Clients
 *
 * @author cif
 */
class Clients extends BaseController {
    public function index(): string
    {
        $model = model(ClientsModel::class);

        $data = [
            'clients_list' => $model->getClients(),
            'title'     => 'Clients archive',
        ];

        return view('templates/header', $data)
            . view('clients/index')
            . view('templates/footer');
    }

    public function show(?int $client_id = null): string
    {
        $model = model(ClientsModel::class);

        $data['clients'] = $model->getClients($client_id);

        if ($data['clients'] === null) {
            throw new PageNotFoundException('Cannot find the clients item: ' . $client_id);
        }

        $data['title'] = $data['clients']['nom_client'] . " " . $data['clients']['prenom_client'];

        return view('templates/header', $data)
            . view('clients/view')
            . view('templates/footer');
    }

    public function new(): string
    {
        helper('form');

        return view('templates/header', ['title' => 'Create a clients item'])
            . view('clients/create')
            . view('templates/footer');
    }

    /**
     * @throws ReflectionException
     */
    public function create(): string
    {
        helper('form');

        $data = $this->request->getPost(['nom', 'prenom', 'adresse', 'password', 'telephone', 'password_conf', 'email']);

        // Checks whether the submitted data passed the validation rules.
        if (! $this->validateData($data, [
            'nom' => 'required|trim|max_length[255]|min_length[3]',
            'prenom' => 'required|trim|max_length[255]|min_length[3]',
            'adresse'  => 'required|trim|max_length[500]|min_length[10]',
            'password'  => 'required|trim|matches[password_conf]|max_length[500]|min_length[8]',
            'password_conf' => 'trim|required',
            'telephone'  => 'required|trim|max_length[10]|min_length[10]',
            "email" => "required|trim|valid_email|is_unique[clients.email]|max_length[320]|min_length[10]",
        ])) {
            // The validation fails, so returns the form.
            return $this->new();
        }

        // Gets the validated data.
        $post = $this->validator->getValidated();

        $model = model(ClientsModel::class);

        $model->save([
            'nom_client' => $post['name'],
            'prenom_client' => $post['firstName'],
            'email_client' => $post['email'],
            'password_client' => password_hash($post['password'], PASSWORD_DEFAULT),
            'telephone_client' => $post['phone'],
            'adresse_client' => $post['address']
        ]);

        return view('templates/header', ['title' => 'Create a clients item'])
            . view('clients/success')
            . view('templates/footer');
    }
}
