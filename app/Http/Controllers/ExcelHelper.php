<?php

namespace App\Http\Controllers;

class ExcelHelper
{
    public static function cleanText($value) {
        if (!$value) return $value;
        return trim(strval($value));
    }
    public static function cleanNumber($value) {
        if (!$value) return $value;
        $trimmed = trim(strval($value));
        if (!$trimmed) return $trimmed;
        if (!preg_match('/^[0-9]+$/', $trimmed)) return ['isInvalid' => true, 'value' => null];
        else return ['isInvalid' => false, 'value' => (int)$trimmed];
    }
}
