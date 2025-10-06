<?php
namespace App\Common;
use Illuminate\Support\Facades\Request;

class Sanitizer {
    public static function xss_clean(): void
    {
        $sanitized = static::cleanArray(Request::all());
        Request::merge($sanitized);
    }
    public static function cleanArray($array): array
    {
        $result = [];
        foreach ($array as $key => $value) {
            $key = strip_tags($key);
            if (is_array($value)) {
                $result[$key] = static::cleanArray($value);
            } else {
                $result[$key] = strip_tags($value);
            }
        }
        return $result;
    }
}
