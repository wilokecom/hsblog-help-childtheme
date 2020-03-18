<?php

namespace TikiDocsChild\Controllers;


use TikiDocsChild\Helpers\TicketHelper;

class TopicActionsController
{
    public function __construct()
    {
        add_filter('bbp_get_toggle_topic_actions', [$this, 'addMoreActions']);
        add_filter('bbp_toggle_topic', [$this, 'updateCloseTicketForever'], 10, 2);
        add_filter('bbp_is_topic_closed', [$this, 'isTicketClosed']);
    }

    public function addMoreActions($aActions)
    {
        array_push($aActions, 'bbp_toggle_topic_close_forever');
        return $aActions;
    }

    public function isTicketClosed($isClosed)
    {
        if ($isClosed) {
            return $isClosed;
        }

        return TicketHelper::isTicketClosedForever();
    }

    public function updateCloseTicketForever($retval, $r)
    {
        if ($r['action'] !== 'bbp_toggle_topic_close_forever') {
            return $retval;
        }

        $nonce_suffix = bbp_get_topic_post_type() . '_' . (int)$r['id'];
        check_ajax_referer("close-{$nonce_suffix}");

        update_post_meta($r['id'], '_bbp_status', 'close_forever');
        wp_update_post($r['id'], [
            'post_status' => 'closed'
        ]);

        return $retval;
    }
}
