<?php

namespace App\Entities\Cast;

use CodeIgniter\Entity\Cast\BaseCast;
use InvalidArgumentException;

class EnumCast extends BaseCast
{
    /**
     * Converts the stored value from the database into an Enum instance.
     *
     * @param mixed $value The raw value from the database.
     * @param array $params Additional parameters (should include the Enum class name).
     * @return mixed Enum instance or raw value if the Enum class is not provided.
     */
    public static function get($value, array $params = []): mixed
    {
        if (empty($params[0]) || !enum_exists($params[0])) {
            throw new InvalidArgumentException('EnumCast: Enum class not specified or invalid in $params.');
        }

        // Check if the value is null or not set, handle it gracefully
        $enumClass = $params[0];

        if (is_null($value)) {
            return null;
        }

        // Convert value to Enum instance
        return $enumClass::tryFrom($value) ?? throw new InvalidArgumentException("Invalid value '{$value}' for Enum {$enumClass}");
    }

    /**
     * Converts an Enum instance (or raw value) into a storable format for the database.
     *
     * @param mixed $value The Enum instance or raw value to store.
     * @param array $params Additional parameters (should include the Enum class name).
     * @return mixed String or integer representation of the Enum instance.
     */
    public static function set($value, array $params = []): mixed
    {
        if (empty($params[0]) || !enum_exists($params[0])) {
            throw new InvalidArgumentException('EnumCast: Enum class not specified or invalid in $params.');
        }

        $enumClass = $params[0];

        // Allow null values for nullable fields
        if (is_null($value)) {
            return null;
        }

        // Ensure the value is a valid Enum instance or raw value matching an Enum case
        if ($value instanceof $enumClass) {
            return $value->value;
        }

        if ($enumClass::tryFrom($value)) {
            return $value;
        }

        throw new InvalidArgumentException("Invalid value '{$value}' for Enum {$enumClass}");
    }
}