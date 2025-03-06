<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class AdminController extends BaseController
{
    // TODO: vérifier si l'utilisateur connecté est un admin
    public function dashboard(): string
    {
        // TODO: affiche le panel admin
    }

    public function index(): string
    {
        // TODO: Affiche une liste des administrateurs
    }

    public function create(): string
    {
        // TODO: Créer un admin
    }

    public function edit(int $adminId): string
    {
        // TODO: Ajouter la logique pour valider une réservation par un administrateur
    }

    public function delete(int $adminId): string
    {
        // TODO: Ajouter la logique pour gérer les logements (ajouter, modifier, supprimer) en appelant RoomController du dossier Admin
    }
}