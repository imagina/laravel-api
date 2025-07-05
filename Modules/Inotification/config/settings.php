<?php

return [
    'logoEmail' => [
        'default' => (object)['mainimage' => null],
        'name' => 'medias_single',
        'fakeFieldName' => 'inotification::logoEmail',
        'type' => 'media',
        'groupName' => 'media',
        'groupTitle' => 'isite::settingGroups.media',
        'props' => [
            'label' => 'inotification::settings.logoEmail',
            'zone' => 'mainimage',
            'entity' => "Modules\Isetting\Models\Setting",
            'entityId' => null
        ]
    ],
    'templateEmail' => [
        'default' => 'inotification::emails.layouts.default',
        'name' => 'inotification::templateEmail',
        'type' => 'select',
        'props' => [
            'label' => 'inotification::settings.labelTemplateEmail',
            'options' => [
                ['label' => 'Default Template', 'value' => 'inotification::emails.layouts.default'],
            ]
        ]
    ],
    'contentEmail' => [
        'default' => 'inotification::emails.contents.default',
        'name' => 'inotification::contentEmail',
        'type' => 'select',
        'props' => [
            'label' => 'inotification::settings.labelContentEmail',
            'options' => [
                ['label' => 'Default Content', 'value' => 'inotification::emails.contents.default'],
                ['label' => 'Content 1', 'value' => 'inotification::emails.contents.content-1'],
            ]
        ]
    ],
    'usersToNotify' => [
        'name' => 'inotification::usersToNotify',
        'default' => [],
        'type' => 'select',
        'columns' => 'col-12 col-md-6',
        'loadOptions' => [
            'apiRoute' => 'apiRoutes.quser.users',
            'select' => ['label' => 'email', 'id' => 'id'],
        ],
        'props' => [
            'label' => 'inotification::settings.usersToNotify',
            'multiple' => true,
            'clearable' => true,
        ],
    ],
];
