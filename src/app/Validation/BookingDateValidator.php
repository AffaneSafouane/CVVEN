<?php

namespace App\Validation;

class BookingDateValidator
{
    // Ceci est une solution temporaire, utiliser une API dans l'idéal
    public static function isRoomDateValid(string $startingDate, ?string &$error = null): bool
    {
        $vacationRange = [
            ['start' => '2025-02-15', 'end' => '2025-03-02'],
            ['start' => '2025-04-19', 'end' => '2025-05-04'],
            ['start' => '2025-10-18', 'end' => '2025-11-02'],
            ['start' => '2025-07-07', 'end' => '2025-09-01'],
            ['start' => '2025-12-20', 'end' => '2026-01-04']
        ];

        if (empty($startingDate)) {
            $error = 'Date du séjour nécessaire.';
            return false;
        }
        $endingDate = date('Y-m-d', strtotime($startingDate . ' + 7 day'));

        foreach ($vacationRange as $date) {
            $startDate = $date['start'];
            $endDate = $date['end'];

            if ($startingDate >= $startDate && $endingDate <= $endDate) {
                return true;
            }
        }

        $error = "Les dates saisies ne sont pas disponibles. Seules les dates pendant les vacances scolaires sont disponibles pour les chambres.";
        return false;
    }
}