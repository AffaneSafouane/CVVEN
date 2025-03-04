<?php

namespace App\Libraries;

class BookingDateValidator
{
    // Ceci est une solution temporaire, utiliser une API dans l'idéal
    public static function isMeetingRoomDateValid(string $startingDate, string $endingDate, ?string &$error = null): bool
    {
        $vacationRange = [
            ['start' => '2025-04-19', 'end' => '2025-05-04'],
            ['start' => '2025-10-18', 'end' => '2025-11-02'],
            ['start' => '2025-12-20', 'end' => '2026-01-04']
        ];

        if ($startingDate <= $endingDate) {
            foreach ($vacationRange as $date) {
                $startDate = $date['start'];
                $endDate = $date['end'];

                if ($startingDate >= $startDate && $endingDate <= $endDate) {
                    return true;
                }
            }
        }

        $error = "Les dates saisies ne sont pas disponibles. Seuls les dates pendant les vacances de pacques, de la toussaint et de noël sont disponibles pour les salles de réunion.";
        return false;
    }

    public static function isRoomDateValid(string $startingDate, string $endingDate, ?string &$error = null): bool
    {
        $vacationRange = [
            ['start' => '2025-02-15', 'end' => '2025-03-02'],
            ['start' => '2025-04-19', 'end' => '2025-05-04'],
            ['start' => '2025-10-18', 'end' => '2025-11-02'],
            ['start' => '2025-07-07', 'end' => '2025-09-01'],
            ['start' => '2025-12-20', 'end' => '2026-01-04']
        ];

        if ($startingDate <= $endingDate) {
            foreach ($vacationRange as $date) {
                $startDate = $date['start'];
                $endDate = $date['end'];

                if ($startingDate >= $startDate && $endingDate <= $endDate) {
                    return true;
                }
            }
        }

        $error = "Les dates saisies ne sont pas disponibles. Seuls les dates pendant les vacances scolaires sont disponibles pour les chambres.";

        return false;
    }
}