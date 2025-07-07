<?php

return [
    /**
     * Data to seeder - Defaults
     */
    "notificationTypes" => [
        ["title" => "SMS", "system_name" => "sms"],
        ["title" => "Whatsapp", "system_name" => "whatsapp"],
        ["title" => "Slack", "system_name" => "slack"],
        ["title" => "Email", "system_name" => "email"],
        ["title" => "Push", "system_name" => "push"],
        ["title" => "Broadcast", "system_name" => "broadcast"],
    ],

    /**
     * Data to seeder - Defaults
     */
    "providers" => [
        "email" => [
            "title" => "Email",
            "systemName" => "email",
            "status" => 1,
            "default" => 1,
            "icon" => "far fa-envelope",
            "color" => "#ff1400",
            "rules" => [
                "email"
            ],
            "type" => 'email',
            "fields" => [
                "id" => [
                    'value' => null,
                ],
                "type" => [
                    "name" => "type",
                    'value' => 'email',
                    'type' => 'hidden',
                ],
                "fromName" => [
                    "name" => "fromName",
                    'value' => '',
                    "isFakeField" => 'fields',
                    'type' => 'input',
                    'required' => true,
                    'props' => [
                        'label' => 'From Name *',
                        "hint" => "The name the notification should come from"
                    ],
                ],
                "fromAddress" => [
                    "name" => "fromAddress",
                    'value' => '',
                    'type' => 'input',
                    "isFakeField" => 'fields',
                    'required' => true,
                    'props' => [
                        'type' => 'email',
                        'label' => 'From Address *',
                        "hint" => "The email address the notification should come from"
                    ],
                ],
                "status" => [
                    "name" => "status",
                    'value' => '0',
                    'type' => 'select',
                    'required' => true,
                    'props' => [
                        'label' => 'Enable',
                        'options' => [
                            ["label" => 'enabled', "value" => '1'],
                            ["label" => 'disabled', "value" => '0'],
                        ],
                    ],
                ],
                "default" => [
                    "name" => "default",
                    'value' => false,
                    'type' => 'checkbox',
                    'props' => [
                        'label' => 'Default',
                    ],
                ],
                "saveInDatabase" => [
                    "name" => "saveInDatabase",
                    'value' => '0',
                    'type' => 'select',
                    "isFakeField" => 'fields',
                    'required' => true,
                    'props' => [
                        'label' => 'Save in database',
                        'options' => [
                            ["label" => 'enabled', "value" => '1'],
                            ["label" => 'disabled', "value" => '0'],
                        ],
                    ],
                ],
            ],
            "settings" => [
                "recipients" => [
                    "name" => "recipients",
                    'value' => '',
                    'type' => 'input',
                    "isFakeField" => 'settings',
                    'props' => [
                        'label' => 'Recipients',
                        "hint" => "Enter recipient email address(es) - separate entries with commas"
                    ],
                ],
                "emailTemplate" => [
                    "name" => "emailTemplate",
                    'value' => '',
                    'type' => 'select',
                    "isFakeField" => 'settings',
                    'loadOptions' => [
                        'apiRoute' => 'apiRoutes.notification.templates',
                        'select' => ['label' => 'title', 'id' => 'id']
                    ],
                    'options' => [
                        ['label' => 'Default', 'id' => 'default']
                    ],
                    'props' => [
                        'label' => 'Email Template',
                        "hint" => "Choose the notification email template. You can create new email templates in Email Templates"
                    ],
                ],
                "status" => [
                    "name" => "status",
                    'value' => '0',
                    'type' => 'select',
                    'required' => true,
                    'props' => [
                        'label' => 'Enable',
                        'options' => [
                            ["label" => 'enabled', "value" => '1'],
                            ["label" => 'disabled', "value" => '0'],
                        ],
                    ],
                ],
                "saveInDatabase" => [
                    "name" => "saveInDatabase",
                    'value' => '0',
                    'type' => 'select',
                    'required' => true,
                    'props' => [
                        'label' => 'Save in database',
                        'options' => [
                            ["label" => 'enabled', "value" => '1'],
                            ["label" => 'disabled', "value" => '0'],
                        ],
                    ],
                ],
            ]
        ]
    ],
];
