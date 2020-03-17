<?php

namespace TikiDocsChild\Helpers;


class App
{
    protected static $aRegistry = [];

    public static function build($key, $val)
    {
        self::$aRegistry[$key] = $val;
    }

    public static function get($key)
    {
        if (array_key_exists($key, self::$aRegistry)) {
            return self::$aRegistry[$key];
        }

        return false;
    }
}
