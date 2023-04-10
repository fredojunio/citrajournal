<?php

namespace App\Helpers;

class AppHelper
{
    public static function rp(int $value)
    {
        $number = number_format($value, 0, ',', '.');
        $result = 'Rp. ' . $number . ',-';
        return $result;
    }

    public static function date($date)
    {
        $result = \Carbon\Carbon::parse($date)->format('d/m/Y');
        return $result;
    }

    public static function instance()
    {
        return new AppHelper();
    }
}
