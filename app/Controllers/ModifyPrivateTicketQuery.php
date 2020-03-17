<?php

namespace TikiDocsChild\Controllers;


final class ModifyPrivateTicketQuery extends Controller
{
    public function __construct()
    {
        add_filter('posts_join', [$this, 'joinPostMeta'], 10, 2);
        add_filter('posts_where', [$this, 'pickupValidTicketType'], 10, 2);
//        add_filter('posts_request', [$this, 'request'], 10, 2);
    }

    public function request($request, $that)
    {
        var_export($request);
        die;
    }

    /**
     * @return bool
     */
    private function isModifyQuery($that)
    {
        if ($that->query_vars['post_type'] !== 'topic') {
            return false;
        }

        if (current_user_can('administrator')) {
            return false;
        }

        return true;
    }

    public function pickupValidTicketType($where, $that)
    {
        if (!$this->isModifyQuery($that)) {
            return $where;
        }

        global $wpdb;
        if (is_user_logged_in()) {
            $currentUserID = abs(get_current_user_id());
            $conditional = "(wiloke_bb_postmeta.meta_key='" . $this->privateTicketMetaKey . "' AND ((wiloke_bb_postmeta.meta_value='no') OR (wiloke_bb_postmeta.meta_value='yes' AND $currentUserID = $wpdb->posts.post_author)))";
        } else {
            $conditional = "(wiloke_bb_postmeta.meta_key='" . $this->privateTicketMetaKey . "' AND wiloke_bb_postmeta.meta_value='no')";
        }

        $where .= " AND (" . $conditional . ')';

        return $where;
    }

    public function joinPostMeta($join, $that)
    {
        if (!$this->isModifyQuery($that)) {
            return $join;
        }

        global $wpdb;
        $postmeta = $wpdb->postmeta;

        $join .= " LEFT JOIN $postmeta as wiloke_bb_postmeta ON ($wpdb->posts.ID = wiloke_bb_postmeta.post_id)";

        return $join;
    }
}
