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
    'minDropoffDays' => [
        'default' => 0,
        'name' => 'irentcar::minDropoffDays',
        "onlySuperAdmin" => true,
        'dynamicField' => [
            'type' => 'input',
            'colClass' => 'col-12 col-md-6',
            'props' => [
                'label' => 'irentcar::settings.minDropoffDays',
                'type' => 'number'
            ]
        ]
    ],
    'maxDropoffDays' => [
        'default' => 0,
        'name' => 'irentcar::maxDropoffDays',
        "onlySuperAdmin" => true,
        'dynamicField' => [
            'type' => 'input',
            'colClass' => 'col-12 col-md-6',
            'props' => [
                'label' => 'irentcar::settings.maxDropoffDays',
                'type' => 'number'
            ]
        ]
    ],
    'minAdvanceMinutes' => [
        'default' => 30,
        'name' => 'irentcar::minAdvanceMinutes',
        "onlySuperAdmin" => true,
        'dynamicField' => [
            'type' => 'input',
            'colClass' => 'col-12 col-md-6',
            'props' => [
                'label' => 'irentcar::settings.minAdvanceMinutes',
                'type' => 'number'
            ]
        ]
    ],
    'slotsInvervalMinutes' => [
        'default' => 30,
        'name' => 'irentcar::slotsInvervalMinutes',
        "onlySuperAdmin" => true,
        'dynamicField' => [
            'type' => 'input',
            'colClass' => 'col-12 col-md-6',
            'props' => [
                'label' => 'irentcar::settings.slotsInvervalMinutes',
                'type' => 'number'
            ]
        ]
    ],
    'slotRangeStart' => [
        'default' => "08:00",
        'name' => 'irentcar::slotRangeStart',
        "onlySuperAdmin" => true,
        'dynamicField' => [
            'type' => 'input',
            'colClass' => 'col-12 col-md-6',
            'props' => [
                'label' => 'irentcar::settings.slotRangeStart'
            ]
        ]
    ],
    'slotRangeEnd' => [
        'default' => "20:00",
        'name' => 'irentcar::slotRangeEnd',
        "onlySuperAdmin" => true,
        'dynamicField' => [
            'type' => 'input',
            'colClass' => 'col-12 col-md-6',
            'props' => [
                'label' => 'irentcar::settings.slotRangeEnd'
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
    'configurationToGetAvailableGammas' => [
        'default' => "by-date-range",
        'name' => 'irentcar::configurationToGetAvailableGammas',
        "onlySuperAdmin" => true,
        'dynamicField' => [
            'type' => 'select',
            'colClass' => 'col-12 col-md-6',
            'props' => [
                'label' => 'irentcar::settings.configurationToGetAvailableGammas',
                'useInput' => false,
                'useChips' => false,
                'multiple' => false,
                'hideDropdownIcon' => true,
                'newValueMode' => 'add-unique',
                'options' => [
                    ['label' => 'Por rango de fecha de la reservacion', 'value' => "by-date-range"],
                    ['label' => 'Por fecha de recogida', 'value' => "by-pickup-date"],
                ]
            ]
        ]
    ],

];
