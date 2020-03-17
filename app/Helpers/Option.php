<?php

namespace TikiDocsChild\Helpers;


class Option
{
    protected static $aOptions;

    public static function get()
    {
        if (!empty(self::$aOptions)) {
            return self::$aOptions;
        }

        self::$aOptions = get_option('tikidocs');
        return self::$aOptions;
    }

    public static function getDetail($field)
    {
        self::get();

        if (array_key_exists($field, self::$aOptions)) {
            return self::$aOptions[$field];
        }

        return false;
    }

    public static function isFocusPrivateMode()
    {
        return self::getDetail('tikidocs_focus_private_ticket') === 'yes';
    }

    public static function getDefaultTicketType()
    {
        return self::getDetail('tikidocs_ticket_type');
    }
}
