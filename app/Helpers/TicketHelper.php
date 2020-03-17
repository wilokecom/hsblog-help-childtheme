<?php

namespace TikiDocsChild\Helpers;

/**
 * Class checkPrivate
 */
class TicketHelper
{
    /**
     * @return bool
     */
    public static function canSeeTicket()
    {
        global $post;
        if (!is_user_logged_in()) {
            auth_redirect();
        }

        if (PostMeta::isPrivateTicket($post->ID) === 'yes') {
            if (current_user_can('administrator') || wp_get_current_user()->ID !== $post->post_author) {
                return true;
            }
        }

        return false;
    }

    public static function isPrivateTicket($ticketID)
    {
        $ticketID = empty($ticketID) ? bbp_get_topic_id() : $ticketID;
        return PostMeta::isPrivateTicket($ticketID);
    }

    public static function generateTicketClasses($additionalClasses = '', $ticketID = '')
    {
        if (TicketHelper::isPrivateTicket($ticketID)) {
            $additionalClasses .= ' hsblog-private-ticket';
        }

        return $additionalClasses;
    }
}
