<?php
return [
    'themeoptions' => [
        'bbsettings' => [
            'section' => [
                'title' => 'BB Settings',
                'id' => 'tikidocs_bb_section',
                'icon' => 'el el-icon-myspace'
            ],
            'subSection' => [
                [
                    'title' => 'BB Settings',
                    'id' => 'tikidocs_bb_section_settings',
                    'subsection' => true,
                    'fields' => [
                        [
                            'title' => 'Is focus private ticket?',
                            'id' => 'tikidocs_focus_private_ticket',
                            'type' => 'select',
                            'options' => [
                                'yes' => 'Yes',
                                'no' => 'No'
                            ],
                            'default' => 'no'
                        ],
                        [
                            'title' => 'Default Ticket Type',
                            'id' => 'tikidocs_ticket_type',
                            'type' => 'select',
                            'options' => [
                                'publish' => 'Publish',
                                'private' => 'Private'
                            ],
                            'default' => 'private'
                        ]
                    ]
                ]
            ]
        ]
    ]
];
