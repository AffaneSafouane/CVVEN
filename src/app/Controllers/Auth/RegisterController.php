<?php

namespace App\Controllers\Auth;

use App\Entities\Client;
use App\Models\ClientModel;
use CodeIgniter\Events\Events;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\Shield\Authentication\Authenticators\Session;
use CodeIgniter\Shield\Controllers\RegisterController as ShieldRegister;
use CodeIgniter\Shield\Entities\User;
use CodeIgniter\Shield\Exceptions\ValidationException;
use CodeIgniter\Shield\Models\UserModel;
use CodeIgniter\Shield\Traits\Viewable;
use CodeIgniter\Shield\Validation\ValidationRules;
use Exception;

/**
 * Class RegisterController
 * Handles displaying registration form, and handling actual registration flow.
 */
class RegisterController extends ShieldRegister
{
    /**
     * Attempts to register the user.
     */
    public function registerAction(): RedirectResponse
    {
        $validation = service('validation');

        if (auth()->loggedIn()) {
            return redirect()->to(config('Auth')->registerRedirect());
        }

        // Check if registration is allowed
        if (! setting('Auth.allowRegistration')) {
            return redirect()->back()->withInput()
                ->with('error', lang('Auth.registerDisabled'));
        }

        $users = $this->getUserProvider();

        // Validate here first, since some things,
        // like the password, can only be validated properly here.
        $rules = $this->getValidationRules();
        $allowedPostFields = array_keys($rules);
        $userData = $this->request->getPost($allowedPostFields);

        if (! $this->validateData($userData, $rules, [], config('Auth')->DBGroup)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Save the user
        $user = $this->getUserEntity();
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

        if (!$validation->run($clientData, 'clientRegistration')) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $client = new Client();
        $client->fill($clientData);

        if (empty($client->phone)) {
            $client->phone = null;
        }

        $db = db_connect();
        try {
            $db->transStart();
            $users->save($user);

            $client->clientId = $users->getInsertID();

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

        // To get the complete user object with ID, we need to get from the database
        $user = $users->findById($users->getInsertID());

        // Add to default group
        $users->addToDefaultGroup($user);

        Events::trigger('register', $user);

        /** @var Session $authenticator */
        $authenticator = auth('session')->getAuthenticator();

        $authenticator->startLogin($user);

        // If an action has been defined for register, start it up.
        $hasAction = $authenticator->startUpAction('register', $user);
        if ($hasAction) {
            return redirect()->route('auth-action-show');
        }

        // Set the user active
        $user->activate();

        $authenticator->completeLogin($user);

        // Success!
        return redirect()->to(config('Auth')->registerRedirect())
            ->with('message', lang('Auth.registerSuccess'));
    }
}