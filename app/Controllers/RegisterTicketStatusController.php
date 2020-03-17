<?php

namespace TikiDocsChild\Controllers;


use TikiDocsChild\Helpers\Option;
use TikiDocsChild\Helpers\PostMeta;
use TikiDocsChild\Models\PrivateCheckModel;
use WilokeListingTools\Framework\Helpers\GetSettings;

class RegisterTicketStatusController extends Controller
{
    /**
     * @var string
     */
    /**
     * @var array
     */
    private $aSlugs = ['topic', 'reply'];

    /**
     * PrivateCheckController constructor.
     */
    public function __construct()
    {
        if (is_admin()) {
            add_action('load-post.php', [$this, 'initMetabox']);
            add_action('load-post-new.php', [$this, 'initMetabox']);
        }

        add_action('bbp_theme_after_topic_form_submit_wrapper', [$this, 'addSelectTicketType']);
        add_action('bbp_new_topic', [$this, 'savePrivateField'], 10, 1);
        add_action('bbp_edit_topic', [$this, 'savePrivateField'], 10, 1);
    }

    /**
     * checkPrivate
     */
    public function addSelectTicketType()
    {
        if (Option::isFocusPrivateMode()) {
            return false;
        }
        $sValue = PostMeta::isPrivateTicket(bbp_get_topic_id(), $this->privateTicketMetaKey);
        ?>
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
        $sValue = $sValue === true ? 'yes' : $sValue;

        ?>
        <select id='wilcity_private' name='wilcity_private'>
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
        if (isset($_POST)) {
            if (Option::isFocusPrivateMode()) {
                update_post_meta($topic_id, $this->privateTicketMetaKey, 'yes');
            } else {
                if (array_key_exists($this->privateTicketMetaKey, $_POST)) {
                    update_post_meta($topic_id, $this->privateTicketMetaKey, $_POST[$this->privateTicketMetaKey]);
                }
            }
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
        $sValue = PostMeta::isPrivateTicket($post->ID, $this->privateTicketMetaKey);
        ?>
        <p>
            <strong class="label"><?php esc_html_e('Private:', 'bbpress'); ?></strong>
            <?php $this->selectBox($sValue); ?>
        </p>
        <?php
    }
}
