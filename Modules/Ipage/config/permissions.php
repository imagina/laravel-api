<?php

return [
    'iuser.users' => [
        'manage' => [
            'title' =>  'iuser::users.manage.title',
            'description' => 'iuser::users.manage.description',
            'onlyFor' => ['super-admin'],
            'defaultAccess' => []
        ],
        'index' => [
            'title' =>  'iuser::users.list.title',
            'description' => 'iuser::users.list.description',
            'onlyFor' => [],
            'defaultAccess' => []
        ],
        'create' => [
            'title' =>  'iuser::users.create.title',
            'description' => 'iuser::users.create.description',
            'onlyFor' => ['super-admin'],
            'defaultAccess' => []
        ],
        'edit' => [
            'title' =>  'iuser::users.edit.title',
            'description' => 'iuser::users.edit.description',
            'onlyFor' => ['super-admin'],
            'defaultAccess' => []
        ],
        'destroy' => [
            'title' =>  'iuser::users.destroy.title',
            'description' => 'iuser::users.destroy.description',
            'onlyFor' => ['super-admin'],
            'defaultAccess' => []
        ],
        'restore' => [
            'title' =>  'iuser::users.restore.title',
            'description' => 'iuser::users.restore.description',
            'onlyFor' => ['super-admin'],
            'defaultAccess' => []
        ]
    ],
];
