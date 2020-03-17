<?php

namespace TikiDocsChild\Helpers;


class PostMeta
{
    /**
     * @param $postID
     * @param $key
     * @param string $default
     * @param bool $isSingle
     * @return mixed|string
     */
    public static function get($postID, $key, $default = '', $isSingle = true)
    {
        $val = get_post_meta($postID, $key, $isSingle);

        if (empty($val)) {
            return $default;
        }

        return $val;
    }

    /**
     * @param $postID
     * @param $key
     * @return mixed|string
     */
    public static function isPrivateTicket($postID, $key = 'wilcity_private')
    {
        $status = self::get($postID, $key, Option::getDefaultTicketType(), true);
        return $status === 'private' || $status === 'yes';
    }
}
