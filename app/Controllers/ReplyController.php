<?php

namespace TikiDocsChild\Controllers;


use TikiDocsChild\Helpers\TicketHelper;

class ReplyController
{
    public function __construct()
    {
        add_filter('bbp_current_user_can_access_create_reply_form', [$this, 'isUserCanReply']);
    }

    public function isUserCanReply($status)
    {
        if (!$status) {
            return $status;
        }

        if (TicketHelper::isTicketClosedForever()) {
            return false;
        }

        return true;
    }
}
