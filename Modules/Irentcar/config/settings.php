<?php

return [
    'ivaRate' => [
        'default' => 0,
        'name' => 'irentcar::ivaRate',
        "onlySuperAdmin" => true,
        'dynamicField' => [
            'type' => 'input',
            'colClass' => 'col-12 col-md-6',
            'props' => [
                'label' => 'irentcar::settings.ivaRate',
                'type' => 'number'
            ]
        ]
    ],
    'minReservationDays' => [
        'default' => 1,
        'name' => 'irentcar::minReservationDays',
        "onlySuperAdmin" => true,
        'dynamicField' => [
            'type' => 'input',
            'colClass' => 'col-12 col-md-6',
            'props' => [
                'label' => 'irentcar::settings.minReservationDays',
                'type' => 'number'
            ]
        ]
    ],
    'maxReservationDays' => [
        'default' => 1,
        'name' => 'irentcar::maxReservationDays',
        "onlySuperAdmin" => true,
        'dynamicField' => [
            'type' => 'input',
            'colClass' => 'col-12 col-md-6',
            'props' => [
                'label' => 'irentcar::settings.maxReservationDays',
                'type' => 'number'
            ]
        ]
    ],
    'minAdvanceHours' => [
        'default' => 2,
        'name' => 'irentcar::minAdvanceHours',
        "onlySuperAdmin" => true,
        'dynamicField' => [
            'type' => 'input',
            'colClass' => 'col-12 col-md-6',
            'props' => [
                'label' => 'irentcar::settings.minAdvanceHours',
                'type' => 'number'
            ]
        ]
    ],
    'minDriveAge' => [
        'default' => 25,
        'name' => 'irentcar::minDriveAge',
        "onlySuperAdmin" => true,
        'dynamicField' => [
            'type' => 'input',
            'colClass' => 'col-12 col-md-6',
            'props' => [
                'label' => 'irentcar::settings.minDriveAge',
                'type' => 'number'
            ]
        ]
    ],
];
