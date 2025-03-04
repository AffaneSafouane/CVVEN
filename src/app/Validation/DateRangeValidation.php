<?php

namespace App\Validation;

class DateRangeValidation
{
    public function isValidDateRange($value, string $fieldName, array $data, ?string &$error = null): bool
    {
        $endingDate = $data[$fieldName] ?? null;

        if (!$value || !$endingDate) {
            $error = 'Les dates doivent être renseignées.';
            return false;
        }

        if ($value > $endingDate) {
            $error = "La date de fin doit être postérieur ou égale à la date de début.";
            return false;
        }

        return true;
    }
}