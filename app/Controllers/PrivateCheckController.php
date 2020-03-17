<?php
include get_stylesheet_directory() . '/app/Models/PrivateCheckModel.php';
/**
 * Class PrivateCheckController
 */
class PrivateCheckController
{
    /**
     * @var string
     */
    private $sMetaKey = 'wilcity_private';
    /**
     * @var array
     */
    private $aSlugs = [];
    /**
     * PrivateCheckController constructor.
     */
    public function __construct()
    {
        add_action('bbp_theme_after_topic_form_status', [$this, 'addFrontendSelectBox']);
        add_action('bbp_new_topic', [$this, 'savePrivateField'], 10, 1);
        add_action('bbp_edit_topic', [$this, 'savePrivateField'], 10, 1);
        if (is_admin()) {
            add_action('load-post.php', [$this, 'initMetabox']);
            add_action('load-post-new.php', [$this, 'initMetabox']);
            $this->aSlugs = ['topic', 'reply'];
        }
        add_filter('bbp_get_forum_topic_count', [$this, 'getForumTopicCount'], 10, 2);
        add_filter('bbp_get_forum_topic_count_int', [$this, 'getForumTopicCount'], 10, 2);
    }
    /**
     * checkPrivate
     */
    public function addFrontendSelectBox()
    {
        $sValue = get_post_meta(bbp_get_topic_id(), $this->sMetaKey, true); ?>
        <p>
            <label for='bbp_topic_status'><?php esc_html_e('Private:', 'bbpress'); ?></label><br/>
            <?php $this->selectBox($sValue); ?>
        </p>
        <?php
    }
    /**
     * @param string $sValue
     */
    public function selectBox($sValue = 'yes')
    {
        ?>
        <select name='wilcity_private' id='wilcity_private'>
            <option value='yes' <?php echo ($sValue == 'yes') ? 'selected' : ''; ?>>Yes</option>
            <option value='no'<?php echo ($sValue == 'no') ? 'selected' : ''; ?>>No</option>
        </select>
        <?php
    }
    /**
     * @param int $topic_id
     */
    public function savePrivateField($topic_id = 0)
    {
        if (isset($_POST) && $_POST[$this->sMetaKey] != '') {
            update_post_meta($topic_id, $this->sMetaKey, $_POST[$this->sMetaKey]);
        }
    }
    /**
     * initMetaBox
     */
    public function initMetaBox()
    {
        add_action('add_meta_boxes', [$this, 'addMetaBox']);
    }
    /**
     * addMetaBox
     */
    public function addMetaBox()
    {
        add_action('bbp_topic_metabox', [$this, 'addAdminSelectBox']);
    }
    /**
     * @param $post
     */
    public function addAdminSelectBox($post)
    {
        $sValue = get_post_meta($post->ID, 'wilcity_private', true); ?>
        <p>
            <strong class="label"><?php esc_html_e('Private:', 'bbpress'); ?></strong>
            <?php $this->selectBox($sValue); ?>
        </p>
        <?php
    }

    /**
     * @return int
     * @param $forum_id
     * @param $topics
     */
    public function getForumTopicCount($topics, $forum_id)
    {
        if(current_user_can('administrator')){
            return $topics;
        }
        return PrivateCheckModel::getTopicTotal($this->sMetaKey,'no');
    }
}