<?php

namespace App\Helpers;

class AppHelper
{
    public static function rp(int $value)
    {
        $number = number_format($value < 0 ? -$value : $value, 0, ',', '.');
        $result = 'Rp. ' . $number . ',-';
        if ($value < 0) {
            $result = '(' . $result . ')';
        }
        return $result;
    }

    public static function date($date)
    {
        $result = \Carbon\Carbon::parse($date)->format('d/m/Y');
        return $result;
    }

    public static function decimal($value)
    {
        return round($value, 2);
    }

    public static function instance()
    {
        return new AppHelper();
    }
}
