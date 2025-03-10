<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\RedirectResponse;

class AdminController extends BaseController
{
    public function dashboard(): string
    {
        // TODO: affiche le panel admin
    }

    public function index(): string
    {
        // TODO: Affiche une liste des administrateurs
    }

    public function show($adminId): string
    {
        // TODO: afficher les détails d'un admin
    }

    public function create(): RedirectResponse
    {
        // TODO: Créer un admin
    }

    public function edit(int $adminId): RedirectResponse
    {
        // TODO: Ajouter la logique pour valider une réservation par un administrateur
    }

    public function delete(int $adminId): RedirectResponse
    {
        // TODO: Ajouter la logique pour gérer les logements (ajouter, modifier, supprimer) en appelant RoomController du dossier Admin
    }
}