<?php

namespace App\Controllers;

use App\Entities\Client;
use App\Models\ClientModel;
use App\Models\UserModel;
use CodeIgniter\Events\Events;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\Shield\Authentication\Authenticators\Session;
use CodeIgniter\Shield\Exceptions\PermissionException;
use CodeIgniter\Shield\Exceptions\ValidationException;
use Exception;

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
            'title' => "Informations Client",
        ];

        return view('users/view', $data);
    }

    public function userForm(int $userId): string|RedirectResponse
    {
        helper('form');
        helper('entity');

        $userModel = new UserModel();

        $user = $userModel->find($userId);

        if(!$user) {
            return redirect()->back()->with('error', 'Utilisateur non trouvée');
        }

        $data = [
            'user'  => $user,
            'title' => 'Modifier l\'utilisateur',
        ];

        return view('users/edit', $data);
    }

    public function edit(int $userId): RedirectResponse
    {
        $validation = service('validation');

        if (!auth()->loggedIn()) {
            return redirect()->to('login');
        }

        $users = auth()->getProvider();

        $user = $users->findById($userId);

        if(!$user) {
            return redirect()->back()->with('error', 'Utilisateur non trouvée');
        }

        $rules = $validation->getRuleGroup('registration');

        if(!$this->request->getPost('password')) {
            unset($rules['password']);
            unset($rules['password_confirm']);
        }

        // Validate here first, since some things,
        // like the password, can only be validated properly here.
        $allowedPostFields = array_keys($rules);
        $userData = $this->request->getPost($allowedPostFields);
        $userData['id'] = $userId;

        if (! $this->validateData($userData, $rules, [], config('Auth')->DBGroup)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $user->fill($userData);

        // Workaround for email only registration/login
        // Changed '=== null' to 'empty()'
        if (empty($user->username)) {
            $user->username = null;
        }

        $clientModel = new ClientModel();

        $clientRules = $validation->getRuleGroup('clientRegistration');
        $clientPostFields = array_keys($clientRules);
        $clientData = $this->request->getPost($clientPostFields);
        $clientData['client_id'] = $userId;


        if (!$validation->run($clientData, 'clientRegistration')) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $client = $clientModel->find($userId);
        if(!$client) {
            return redirect()->back()->with('error', 'Client non trouvée');
        }

        $client->fill($clientData);

        // Changed '=== null' to 'empty()'
        if (empty($client->phone)) {
            $client->phone = null;
        }

        $db = db_connect();
        try {
            $db->transStart();
            $users->save($user);

            $client->clientId = $userId;

            if (!$clientModel->save($client)) {
                throw new Exception(implode('<br>', $clientModel->errors()));
            }

            $db->transCommit();
        } catch (ValidationException $e) {
            $db->transRollback();
            return redirect()->back()->withInput()->with('errors', $users->errors());
        } catch (Exception $e) {
            $db->transRollback();
            return redirect()->back()->withInput()->with('errors', $e->getMessage());
        }

        // Success!
        return redirect()->to('users/' . $user->id)->with('success', 'Client mis à jour avec succès');
    }

    public function delete(?int $userId): RedirectResponse
    {
        $userModel = new UserModel();
        $user = $userModel->find($userId);
        if (!$user) {
            return redirect()->back()->with('error', 'Chambre non trouvée');
        }

        if (!$userModel->delete($userId)) {
            return redirect()->back()->with('errors', $userModel->errors());
        }

        return redirect()->to('login')->with('message', 'Utilisateur supprimée avec succès');
    }
}
