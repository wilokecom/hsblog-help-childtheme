<?php

namespace TikiDocsChild\Controllers;


use TikiDocsChild\Helpers\TicketHelper;

class SingleTicketController
{
    public function __construct()
    {
        add_filter('bbp_get_topic_class', [$this, 'addClassesToTicketList'], 10, 2);
    }

    public function addClassesToTicketList($post_classes, $topic_id)
    {
        $aNewClasses = TicketHelper::generateTicketClasses('', $topic_id);

        array_push($post_classes, $aNewClasses);
        return $post_classes;
    }
}
