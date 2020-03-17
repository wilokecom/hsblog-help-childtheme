<?php

/**
 * Single Topic Content Part
 *
 * @package bbPress
 * @subpackage Theme
 */

    // Exit if accessed directly
defined( 'ABSPATH' ) || exit;
include get_stylesheet_directory().'/app/Helper/PrivateStatus.php';
if(PrivateStatus::checkPrivateStatus()==true){
    die('You can not access this page');
}
else{?>
    <div id="bbpress-forums" class="bbpress-wrapper">

        <?php bbp_breadcrumb(); ?>

        <?php bbp_topic_subscription_link(); ?>

        <?php bbp_topic_favorite_link(); ?>

        <?php do_action( 'bbp_template_before_single_topic' ); ?>

        <?php if ( post_password_required() ) : ?>

            <?php bbp_get_template_part( 'form', 'protected' ); ?>

        <?php else : ?>

            <?php bbp_topic_tag_list(); ?>

            <?php bbp_single_topic_description(); ?>

            <?php if ( bbp_show_lead_topic() ) : ?>

                <?php bbp_get_template_part( 'content', 'single-topic-lead' ); ?>

            <?php endif; ?>

            <?php if ( bbp_has_replies() ) : ?>

                <?php bbp_get_template_part( 'pagination', 'replies' ); ?>

                <?php bbp_get_template_part( 'loop',       'replies' ); ?>

                <?php bbp_get_template_part( 'pagination', 'replies' ); ?>

            <?php endif; ?>

            <?php bbp_get_template_part( 'form', 'reply' ); ?>

        <?php endif; ?>

        <?php bbp_get_template_part( 'alert', 'topic-lock' ); ?>

        <?php do_action( 'bbp_template_after_single_topic' ); ?>

    </div>

    <?php
}
?>
