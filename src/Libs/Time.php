<?php

namespace Src\Libs;

use Carbon\Carbon;

class Time 
{

    public static $value;

    private function __construc()
    {
        // return $this;
    }

    public static function create()
    {
        return self::$value;
    }

    public static function now()
    {
        self::$value = Carbon::now();
        return self::$value;
    }


    public static function format($format)
    {
        self::$value = self::$value->format($format);
        return self;
    }
}