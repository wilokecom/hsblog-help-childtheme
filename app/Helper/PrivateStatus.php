<?php
/**
 * Class checkPrivate
 */
class PrivateStatus
{
    /**
     * PrivateStatus constructor.
     */
    public function __construct()
    {
    }
    /**
     * @return bool
     */
    public static function checkPrivateStatus()
    {
        global $post;
        if (!is_user_logged_in()) {
            auth_redirect();
        }
        $iPrivateStatus = get_post_meta($post->ID, 'wilcity_private', true);
        if ($iPrivateStatus == 'yes') {
            if (!current_user_can('administrator') && wp_get_current_user()->ID !== $post->post_author) {
                return true;
            }
        }
        return false;
    }
}