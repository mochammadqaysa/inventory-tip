<?php

namespace App\Helpers;

class Utils
{
    public static function formatSlug($string)
    {
        $string = preg_replace('/[ -]+/', '_', $string);
        $string = preg_replace('/([a-z])([A-Z])/', '$1_$2', $string);
        return strtolower($string);
    }
}
