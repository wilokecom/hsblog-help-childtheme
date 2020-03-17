<?php

namespace TikiDocsChild\Controllers;


use TikiDocsChild\Models\PrivateCheckModel;

class TopicCountController extends Controller
{
    public function __construct()
    {
        add_filter('bbp_get_forum_topic_count', [$this, 'getForumTopicCount'], 10, 2);
        add_filter('bbp_get_forum_topic_count_int', [$this, 'getForumTopicCount'], 10, 2);
    }


    public $query_vars = [
        'post_type' => 'topic'
    ];

    /**
     * @return string|null
     */
    private function getTopicTotal($forumID = '')
    {
        global $wpdb;

        $select = "SELECT COUNT($wpdb->posts.ID) FROM $wpdb->posts";

        $join = apply_filters('posts_join', '', $this);

        $where = " WHERE 1=1 AND $wpdb->posts.post_type='" . $this->query_vars['post_type'] . "' AND $wpdb->posts.post_status IN ('publish') ";

        if (!empty($forumID)) {
            $where .= " AND $wpdb->posts.post_parent=".abs($forumID);
        }

        $where = apply_filters('posts_where', $where, $this);

        $query = $select . $join . $where;

        return $wpdb->get_var($query);
    }

    /**
     * @param $forum_id
     * @param $topics
     * @return int
     */
    public function getForumTopicCount($topics, $forum_id)
    {
        return $this->getTopicTotal($forum_id);
    }
}
