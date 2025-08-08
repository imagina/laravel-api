<?php

return [

    /**
     * =======================================
     * SITE - isite
     * =======================================
     */
    'site-name' => [
        'name' => 'isite::site-name',
        'default' => 'My Site',
        'isTranslatable' => true,
        'dynamicField' => [
            'type' => 'input',
            'columns' => 'col-12 col-md-6',
            'quickSetting' => true,
            'props' => [
                'label' => 'isite::settings.site-name'
            ]
        ]
    ],
    'site-name-mini' => [
        'name' => 'isite::site-name-mini',
        'default' => 'my site',
        'isTranslatable' => true,
        'dynamicField' => [
            'type' => 'input',
            'columns' => 'col-12 col-md-6',
            'props' => [
                'label' => 'isite::settings.site-name-mini'
            ],
        ]
    ],
    'site-description' => [
        'name' => 'isite::site-description',
        'default' => null,
        'isTranslatable' => true,
        'dynamicField' => [
            'type' => 'input',
            'props' => [
                'label' => 'isite::settings.site-description',
                'type' => 'textarea',
                'rows' => 3,
            ],
        ]
    ],
    'locales' => [
        'name' => 'isite::locales',
        'default' => [],
        'dynamicField' => [
            'type' => 'treeSelect',
            "onlySuperAdmin" => true,
            'columns' => 'col-12 col-md-6',
            'props' => [
                'label' => 'isite::settings.locales',
                'multiple' => true,
                'sortdefaultBy' => 'ORDER_SELECTED'
            ],
            'loadOptions' => [
                'apiRoute' => 'apiRoutes.qsite.siteSettings',
                'select' => ['label' => 'name', 'id' => 'iso'],
                'requestParams' => ['filter' => ['settingGroupName' => 'availableLocales']]
            ]
        ]
    ],


    /**
     * =======================================
     * MEDIA
     * =======================================
     */
    'logo1' => [
        'default' => (object)['mainimage' => null],
        'name' => 'isite::logo1',
        'isMedia' => 'medias_single',
        'dynamicField' => [
            'fakeFieldName' => 'mainimage',
            'type' => 'media',
            'groupName' => 'media',
            'groupTitle' => 'isite::settings.groups.media.title',
            'quickSetting' => true,
            'props' => [
                'label' => 'isite::settings.logo1',
                'zone' => 'mainimage',
                'entity' => "Modules\Isetting\Models\Setting",
                'entityId' => null
            ]
        ]
    ],

    'logo2' => [
        'default' => (object)['mainimage' => null],
        'name' => 'isite::logo2',
        'isMedia' => 'medias_single',
        'dynamicField' => [
            'fakeFieldName' => 'mainimage',
            'type' => 'media',
            'groupName' => 'media',
            'groupTitle' => 'isite::settings.groups.media.title',
            'props' => [
                'label' => 'isite::settings.logo2',
                'zone' => 'mainimage',
                'entity' => "Modules\Isetting\Models\Setting",
                'entityId' => null
            ]
        ]
    ],
    'logo3' => [
        'default' => (object)['mainimage' => null],
        'name' => 'isite::logo3',
        'isMedia' => 'medias_single',
        'dynamicField' => [
            'fakeFieldName' => 'mainimage',
            'type' => 'media',
            'groupName' => 'media',
            'groupTitle' => 'isite::settings.groups.media.title',
            'props' => [
                'label' => 'isite::settings.logo3',
                'zone' => 'mainimage',
                'entity' => "Modules\Isetting\Models\Setting",
                'entityId' => null
            ]
        ]
    ],
    'logoIadmin' => [
        'default' => (object)['mainimage' => null],
        'name' => 'isite::logoIadmin',
        'isMedia' => 'medias_single',
        'dynamicField' => [
            'fakeFieldName' => 'mainimage',
            'type' => 'media',
            'groupName' => 'media',
            'groupTitle' => 'isite::settings.groups.media.title',
            'props' => [
                'label' => 'isite::settings.logoIadmin',
                'zone' => 'mainimage',
                'entity' => "Modules\Isetting\Models\Setting",
                'entityId' => null
            ]
        ]
    ],
    'logoIadminSM' => [
        'default' => (object)['mainimage' => null],
        'name' => 'isite::logoIadminSM',
        'isMedia' => 'medias_single',
        'dynamicField' => [
            'fakeFieldName' => 'mainimage',
            'type' => 'media',
            'groupName' => 'media',
            'groupTitle' => 'isite::settings.groups.media.title',
            'props' => [
                'label' => 'isite::settings.logoIadminSM',
                'zone' => 'mainimage',
                'entity' => "Modules\Isetting\Models\Setting",
                'entityId' => null
            ]
        ]
    ],
    'favicon' => [
        'default' => (object)['mainimage' => null],
        'name' => 'isite::favicon',
        'isMedia' => 'medias_single',
        'dynamicField' => [
            'fakeFieldName' => 'mainimage',
            'type' => 'media',
            'groupName' => 'media',
            'groupTitle' => 'isite::settings.groups.media.title',
            'props' => [
                'label' => 'isite::settings.favicon',
                'zone' => 'mainimage',
                'entity' => "Modules\Isetting\Models\Setting",
                'entityId' => null
            ]
        ]
    ],
    //Colors
    'brandPrimary' => [
        'name' => 'isite::brandPrimary',
        'default' => null,
        'dynamicField' => [
            'type' => 'inputColor',
            'groupName' => 'colors',
            'groupTitle' => 'isite::settings.groups.colors.title',
            'colClass' => 'col-12 col-md-6',
            'quickSetting' => true,
            'props' => [
                'label' => 'isite::settings.brandPrimary'
            ]
        ]
    ],
    'primaryContrast' => [
        'name' => 'isite::primaryContrast',
        'default' => null,
        'dynamicField' => [
            'type' => 'inputColor',
            'groupName' => 'colors',
            'groupTitle' => 'isite::settings.groups.colors.title',
            'colClass' => 'col-12 col-md-6',
            'quickSetting' => true,
            'props' => [
                'label' => 'isite::settings.primaryContrast'
            ]
        ]
    ],
    'brandSecondary' => [
        'name' => 'isite::brandSecondary',
        'default' => null,
        'dynamicField' => [
            'type' => 'inputColor',
            'groupName' => 'colors',
            'groupTitle' => 'isite::settings.groups.colors.title',
            'colClass' => 'col-12 col-md-6',
            'quickSetting' => true,
            'props' => [
                'label' => 'isite::settings.brandSecondary'
            ]
        ]
    ],
    'secondaryContrast' => [
        'name' => 'isite::secondaryContrast',
        'default' => null,
        'dynamicField' => [
            'type' => 'inputColor',
            'groupName' => 'colors',
            'groupTitle' => 'isite::settings.groups.colors.title',
            'colClass' => 'col-12 col-md-6',
            'quickSetting' => true,
            'props' => [
                'label' => 'isite::settings.secondaryContrast'
            ]
        ]
    ],
    'brandTertiary' => [
        'name' => 'isite::brandTertiary',
        'default' => null,
        'dynamicField' => [
            'type' => 'inputColor',
            'groupName' => 'colors',
            'groupTitle' => 'isite::settings.groups.colors.title',
            'colClass' => 'col-12 col-md-6',
            'quickSetting' => true,
            'props' => [
                'label' => 'isite::settings.brandTertiary'
            ]
        ]
    ],
    'tertiaryContrast' => [
        'name' => 'isite::tertiaryContrast',
        'default' => null,
        'dynamicField' => [
            'type' => 'inputColor',
            'groupName' => 'colors',
            'groupTitle' => 'isite::settings.groups.colors.title',
            'colClass' => 'col-12 col-md-6',
            'quickSetting' => true,
            'props' => [
                'label' => 'isite::settings.tertiaryContrast'
            ]
        ]
    ],
    'brandQuaternary' => [
        'name' => 'isite::brandQuaternary',
        'default' => null,
        'dynamicField' => [
            'type' => 'inputColor',
            'groupName' => 'colors',
            'groupTitle' => 'isite::settings.groups.colors.title',
            'colClass' => 'col-12 col-md-6',
            'quickSetting' => true,
            'props' => [
                'label' => 'isite::settings.brandQuaternary'
            ]
        ]
    ],
    'quaternaryContrast' => [
        'name' => 'isite::quaternaryContrast',
        'default' => null,
        'dynamicField' => [
            'type' => 'inputColor',
            'groupName' => 'colors',
            'groupTitle' => 'isite::settings.groups.colors.title',
            'colClass' => 'col-12 col-md-6',
            'quickSetting' => true,
            'props' => [
                'label' => 'isite::settings.quaternaryContrast'
            ]
        ]
    ],
    'brandAddressBar' => [
        'name' => 'isite::brandAddressBar',
        'default' => null,
        'dynamicField' => [
            'type' => 'inputColor',
            'groupName' => 'colors',
            'groupTitle' => 'isite::settings.groups.colors.title',
            'colClass' => 'col-12 col-md-6',
            'props' => [
                'label' => 'isite::settings.addressBar'
            ]
        ]
    ],
    'brandAccent' => [
        'name' => 'isite::brandAccent',
        'default' => null,
        'dynamicField' => [
            'type' => 'inputColor',
            'groupName' => 'colors',
            'groupTitle' => 'isite::settings.groups.colors.title',
            'colClass' => 'col-12 col-md-6',
            'props' => [
                'label' => 'isite::settings.brandAccent'
            ]
        ]
    ],
    'brandPositive' => [
        'default' => null,
        'name' => 'isite::brandPositive',
        'dynamicField' => [
            'type' => 'inputColor',
            'groupName' => 'colors',
            'groupTitle' => 'isite::settings.groups.colors.title',
            'colClass' => 'col-12 col-md-6',
            'props' => [
                'label' => 'isite::settings.brandPositive'
            ]
        ]
    ],
    'brandNegative' => [
        'default' => null,
        'name' => 'isite::brandNegative',
        'dynamicField' => [
            'type' => 'inputColor',
            'groupName' => 'colors',
            'groupTitle' => 'isite::settings.groups.colors.title',
            'colClass' => 'col-12 col-md-6',
            'props' => [
                'label' => 'isite::settings.brandNegative'
            ]
        ]
    ],
    'brandInfo' => [
        'default' => null,
        'name' => 'isite::brandInfo',
        'dynamicField' => [
            'type' => 'inputColor',
            'groupName' => 'colors',
            'groupTitle' => 'isite::settings.groups.colors.title',
            'colClass' => 'col-12 col-md-6',
            'props' => [
                'label' => 'isite::settings.brandInfo'
            ]
        ]
    ],
    'brandWarning' => [
        'default' => null,
        'name' => 'isite::brandWarning',
        'dynamicField' => [
            'type' => 'inputColor',
            'groupName' => 'colors',
            'groupTitle' => 'isite::settings.groups.colors.title',
            'colClass' => 'col-12 col-md-6',
            'props' => [
                'label' => 'isite::settings.brandWarning'
            ]
        ]
    ],
    'brandDark' => [
        'default' => null,
        'name' => 'isite::brandDark',
        'dynamicField' => [
            'type' => 'inputColor',
            'groupName' => 'colors',
            'groupTitle' => 'isite::settings.groups.colors.title',
            'colClass' => 'col-12 col-md-6',
            'props' => [
                'label' => 'isite::settings.brandDark'
            ]
        ]
    ],
];
