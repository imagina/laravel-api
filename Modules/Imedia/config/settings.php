<?php

return [
    //    'setting_name' => [
    //        'default' => 'Default Value',
    //        'isTranslatable' => false,
    //    ]
    'allowedImageTypes' => [
        'onlySuperAdmin' => true,
        'name' => 'media::allowedImageTypes',
        'value' => config('asgard.media.config.allowedImageTypes'),
        'type' => 'select',
        'columns' => 'col-12 col-md-6',
        'props' => [
            'useInput' => true,
            'useChips' => true,
            'multiple' => true,
            'hint' => 'media::settings.hint.allowedTypes',
            'hideDropdownIcon' => true,
            'newValueMode' => 'add-unique',
            'label' => 'media::settings.label.allowedImageTypes',
        ],
    ],
    'defaultImageSize' => [
        'onlySuperAdmin' => true,
        'name' => 'media::defaultImageSize',
        'value' => config('asgard.media.config.defaultImageSize'),
        'label' => 'Default Image Size',
        'type' => 'json',
        'columns' => 'col-12',
        'props' => [
            'label' => 'media::settings.label.defaultImageSize',
            'type' => 'textarea',
        ],

    ],

];
