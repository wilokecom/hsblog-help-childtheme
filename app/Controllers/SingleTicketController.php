<?php

namespace TikiDocsChild\Controllers;


use TikiDocsChild\Helpers\TicketHelper;

class SingleTicketController
{
    public function __construct()
    {
        add_filter('bbp_get_topic_class', [$this, 'addClassesToTicketList'], 10, 2);
        add_action('bbp_template_before_single_topic', [$this, 'addToggleOpenCloseTopic']);
    }

    public function addToggleOpenCloseTopic()
    {
        if (TicketHelper::canChangeTicketStatus()) :
            $topicID = bbp_get_topic_id();

            $display = bbp_is_topic_open($topicID) ? 'Close Ticket' : 'Open Ticket';
            $toggleUri = add_query_arg(array('action' => 'bbp_toggle_topic_close', 'topic_id' => $topicID));
            $toggleUri = wp_nonce_url($toggleUri, 'close-topic_' . $topicID);
            ?>
            <a href="<?php echo esc_url($toggleUri); ?>"
               class="bbp-topic-close-link">
                <?php echo esc_html($display); ?>
            </a>

        <?php if (!TicketHelper::isTicketClosedForever()) :
            $closeForeverUri = add_query_arg(array('action' => 'bbp_toggle_topic_close_forever', 'topic_id' => $topicID));
            $closeForeverUri = wp_nonce_url($closeForeverUri, 'close-topic_' . $topicID);
            ?>
            <a href="<?php echo esc_url($closeForeverUri); ?>" class="bbp-topic-close-link">Close Forever</a>
        <?php endif;
        endif;
    }

    public function addClassesToTicketList($post_classes, $topic_id)
    {
        $aNewClasses = TicketHelper::generateTicketClasses('', $topic_id);

        array_push($post_classes, $aNewClasses);
        return $post_classes;
    }
}
