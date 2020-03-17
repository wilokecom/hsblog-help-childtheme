<?php

namespace TikiDocsChild\Controllers;


use TikiDocsChild\Models\PrivateCheckModel;

class RepliedCountController extends Controller
{
    public function __construct()
    {
        add_filter('bbp_get_forum_reply_count_int', [$this, 'countTotalReplied'], 10, 2);
        add_filter('bbp_get_forum_reply_count', [$this, 'countTotalReplied'], 10, 2);
    }

    public $query_vars = [
        'post_type' => 'topic'
    ];

    /**
     * @return string|null
     */
    private function countTotalReplied($forumID = '')
    {
//        global $wpdb;
//
//        $select = "SELECT COUNT($wpdb->posts.ID) FROM $wpdb->posts";
//
//        $join = apply_filters('posts_join', '', $this);
//
//        $where = " WHERE 1=1 AND $wpdb->posts.post_type='" . $this->query_vars['post_type'] . "' AND $wpdb->posts.post_status IN ('publish') ";
//
//        if (!empty($forumID)) {
//            $where .= " AND $wpdb->posts.post_parent=".abs($forumID);
//        }
//
//        $where = apply_filters('posts_where', $where, $this);
//
//        $query = $select . $join . $where;
//
//        return $wpdb->get_var($query);
    }

    /**
     * @param $forum_id
     * @param $topics
     * @return int
     */
    public function getForumTopicCount($topics, $forum_id)
    {
//        return $this->getTopicTotal($forum_id);
    }
}
