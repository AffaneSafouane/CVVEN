<?php

namespace App\Validation;

class DateValidation
{
     public function isValidBirthDate($value, ?string &$error = null): bool
     {
         $minDate = date('Y-m-d', strtotime('90 years ago'));
         $maxDate = date('Y-m-d', strtotime('18 years ago'));

         if ($value < $minDate || $value > $maxDate) {
             $error = "Date de naissance invalide";
             return false;
         }

         return true;
     }
}
