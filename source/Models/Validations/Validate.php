<?php 

namespace Source\Models\Validations;

final class Validate 
{
    final public static function string (string $value) : bool
    {
        if (empty($value)) return false;

        return true;
    }

    final public static function email (string $value) : bool
    {
        if (empty($value)) return false;

        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) return false;

        return true;
    }



    final public static function integer (int $value) : bool
    {
        if (empty($value)) return false;

        return true;
    }
}