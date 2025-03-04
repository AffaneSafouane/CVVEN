<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Enum\ReservationType;
use CodeIgniter\HTTP\ResponseInterface;

class ActivityController extends BaseController
{
    /**
     * Activités différentes selon la période.
     */
    public function index(): string
    {
        // @TODO afficher toutes les activités disponibles
    }

    public function show(int $activityId): string
    {
        // @TODO afficher les détails d'une activité
    }

    /**
     * Ajouter un nombre limite de participants (db).
     * Donner un objet de type Activity pour dates et nb de participants.
     */
    public function new(int $activityId, $type = ReservationType::Activity): string
    {
        // @TODO afficher le formulaire pour une activité
    }
}
