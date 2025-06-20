<?php

return [
    'allowedImageTypes' => [
        'onlySuperAdmin' => true,
        'name' => 'imedia::allowedImageTypes',
        'default' => config('imedia.allowedImageTypes'),
        'type' => 'select',
        'columns' => 'col-12 col-md-6',
        'props' => [
            'useInput' => true,
            'useChips' => true,
            'multiple' => true,
            'hint' => 'imedia::settings.hint.allowedTypes',
            'hideDropdownIcon' => true,
            'newValueMode' => 'add-unique',
            'label' => 'imedia::settings.label.allowedImageTypes',
        ],
    ],
    'defaultImageSize' => [
        'onlySuperAdmin' => true,
        'name' => 'imedia::defaultImageSize',
        'default' => config('imedia.defaultImageSize'),
        'label' => 'Default Image Size',
        'type' => 'json',
        'columns' => 'col-12',
        'props' => [
            'label' => 'imedia::settings.label.defaultImageSize',
            'type' => 'textarea',
        ],

    ],

];
