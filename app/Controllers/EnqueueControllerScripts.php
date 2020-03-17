<?php

namespace TikiDocsChild\Controllers;


class EnqueueControllerScripts
{
    public function __construct()
    {
//        add_action('wp_enqueue_scripts', [$this, 'enqueueScripts']);
    }

    function enqueueScripts()
    {
        wp_enqueue_style(
            'parent-style',
            get_stylesheet_directory_uri() . '/style.css',
            false,
            TIKIDOCS_CHILD_VERSION
        );
    }
}
