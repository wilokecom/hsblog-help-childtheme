<?php
require_once get_stylesheet_directory() . '/vendor/autoload.php';

define('TIKIDOCS_CHILD_VERSION', '1.0');

\TikiDocsChild\Helpers\App::build('app', include get_stylesheet_directory() . '/config/app.php');
if (!is_admin()) {
    new \TikiDocsChild\Controllers\EnqueueControllerScripts();
    new \TikiDocsChild\Controllers\RegisterTicketStatusController();
} else {
    new \TikiDocsChild\Controllers\ThemeOptionController();
}

new \TikiDocsChild\Controllers\ModifyPrivateTicketQuery();
new \TikiDocsChild\Controllers\SingleTicketController();
new \TikiDocsChild\Controllers\TopicCountController();
