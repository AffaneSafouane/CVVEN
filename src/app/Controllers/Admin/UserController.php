<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ClientModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\Shield\Exceptions\UserNotFoundException;
use CodeIgniter\Shield\Exceptions\ValidationException;
use Exception;

class UserController extends BaseController
{
    public function index(): string
    {
        $active = $this->request->getGet('active');
        $group  = $this->request->getGet('group');

        $model = model(UserModel::class);

        // Apply filters
        if ($active !== null && $active !== '') {
            $model->where('active', $active);
        }

        if ($group !== null && $group !== '') {
            $model->select('users.*')
                ->join('auth_groups_users agu', 'agu.user_id = users.id');

            if (is_array($group)) {
                $model->whereIn('agu.group', $group);
            } else {
                $model->where('agu.group', $group);
            }
        }

        $data = [
            'users'    => $model->paginate(10),
            'pager'    => $model->pager,
            'group'    => $group,
            'active'   => $active,
            'title'    => 'Liste des utilisateurs',
        ];

        return view('admin/users/index', $data);
    }

    public function show(int $userId): string
    {
        $userModel = new UserModel();

        $data = [
            'user' => $userModel->find($userId),
            'title' => "Informations client",
        ];

        return view('admin/users/view', $data);
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
        if (!auth()->loggedIn()) {
            return redirect()->to('login');
        }

        $validation = service('validation');
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

        $rules['group'] = 'required|in_list[admin,developer,user,beta]';

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
        $db = db_connect();
        $db->transStart();

        try {
            // Group management - remove old groups and add new one
            foreach ($user->getGroups() as $group) {
                $user->removeGroup($group);
            }
            $user->addGroup($userData['group']);

            // Save user
            if (!$users->save($user)) {
                throw new \Exception('Failed to save user data');
            }

            // Client management based on user group
            if ($user->inGroup('user')) {
                $this->handleClientData($validation, $clientModel, $userId);
            } else {
                $this->removeClientIfExists($clientModel, $userId);
            }

            $db->transCommit();
            return redirect()->to('admin/users/' . $user->id)
                ->with('success', 'Utilisateur mis à jour avec succès');
        } catch (\Exception $e) {
            $db->transRollback();
            return redirect()->back()->withInput()
                ->with('error', $e->getMessage());
        }
    }

    public function delete(?int $userId): RedirectResponse
    {
        $userModel = new UserModel();
        $user = $userModel->find($userId);
        if (!$user) {
            return redirect()->back()->with('error', 'Utilisateur non trouvée');
        }

        if (!$userModel->delete($userId)) {
            return redirect()->back()->with('errors', $userModel->errors());
        }

        return redirect()->to('login')->with('message', 'Utilisateur supprimée avec succès');
    }

    public function suspend(int $userId): RedirectResponse
    {
        // TODO: suspendre le compte d'un utilisateur
    }

    /**
     * Handle client data validation and save
     * @throws Exception
     */
    private function handleClientData($validation, $clientModel, $userId): void
    {
        $clientRules = $validation->getRuleGroup('clientRegistration');
        $clientPostFields = array_keys($clientRules);
        $clientData = $this->request->getPost($clientPostFields);
        $clientData['client_id'] = $userId;

        if (!$validation->run($clientData, 'clientRegistration')) {
            throw new ValidationException($validation);
        }

        $client = $clientModel->find($userId);
        if (!$client) {
            throw new \Exception('Client non trouvé');
        }

        $client->fill($clientData);
        $client->phone = empty($client->phone) ? null : $client->phone;

        if (!$clientModel->save($client)) {
            throw new \Exception(implode('<br>', $clientModel->errors()));
        }
    }

    /**
     * Remove client record if exists
     * @throws Exception
     */
    private function removeClientIfExists($clientModel, $userId): void
    {
        $client = $clientModel->find($userId);
        if ($client) {
            // Use the delete method with the primary key value instead of the entity
            if (!$clientModel->delete($userId)) {
                throw new \Exception(implode('<br>', $clientModel->errors()));
            }
        }
    }
}