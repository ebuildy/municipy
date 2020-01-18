<?php


namespace App\Utils;


class StringUtils
{
    static public function toSnakeCase($string) {
        $string = str_replace(' ', '_', $string);

        return strtolower(preg_replace(['/([a-z\d])([A-Z])/', '/([^_])([A-Z][a-z])/'], '$1_$2', $string));
    }
}