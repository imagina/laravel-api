<?php

return [
  /*
  |--------------------------------------------------------------------------
  | Composer file to merge with main for dev | should match with composer.json/extra/merge-plugin/include
  |--------------------------------------------------------------------------
  */
  'dev_composer_file' => env('IMAGINA_DEV_COMPOSER_FILE', 'composer.local'),

  /*
  |--------------------------------------------------------------------------
  | Default Git branch for DEV installs | should match with composer.local.json requires
  |--------------------------------------------------------------------------
  */
  'dev_branch' => env('IMAGINA_DEV_BRANCH', 'v12.x'),

  /*
  |--------------------------------------------------------------------------
  | Default Production Version for Prod installs
  |--------------------------------------------------------------------------
  */
  'prod_version' => env('IMAGINA_PROD_VERSION', '^1.0'),

  /*
  |--------------------------------------------------------------------------
  | Default required modules (always installed)
  |--------------------------------------------------------------------------
  */
  'default' => [
    [
      'name' => 'icore',
      'git' => 'https://github.com/imagina/imaginacms-icore.git',
      'path' => 'packages/imagina/icore',
      'prodPackage' => 'imagina/icore=v12.x-dev'
    ],
    [
      'name' => 'iworkshop',
      'git' => 'https://github.com/imagina/imaginacms-iworkshop.git',
      'path' => 'packages/imagina/iworkshop',
      'prodPackage' => 'imagina/iworkshop=v12.x-dev'
    ],
  ],

  /*
  |--------------------------------------------------------------------------
  | Optional modules (selectable at install)
  |--------------------------------------------------------------------------
  */
  'optional' => [
    [
      'name' => 'iblog',
      'git' => 'https://github.com/imagina/imaginacms-iblog.git',
      'path' => 'Modules/Iblog',
      'prodPackage' => 'imagina/iblog-module=v12.x-dev'
    ],
    [
      'name' => 'ifillable',
      'git' => 'https://github.com/imagina/imaginacms-ifillable.git',
      'path' => 'Modules/Ifillable',
      'prodPackage' => 'imagina/ifillable-module=v12.x-dev'
    ],
    [
      'name' => 'iform',
      'git' => 'https://github.com/imagina/imaginacms-iform.git',
      'path' => 'Modules/Iform',
      'prodPackage' => 'imagina/iform-module=v12.x-dev'
    ],
    [
      'name' => 'ilocation',
      'git' => 'https://github.com/imagina/imaginacms-ilocation.git',
      'path' => 'Modules/Ilocation',
      'prodPackage' => 'imagina/ilocation-module=v12.x-dev'
    ],
    [
      'name' => 'imedia',
      'git' => 'https://github.com/imagina/imaginacms-imedia.git',
      'path' => 'Modules/Imedia',
      'prodPackage' => 'imagina/imedia-module=v12.x-dev'
    ],
    [
      'name' => 'imenu',
      'git' => 'https://github.com/imagina/imaginacms-imenu.git',
      'path' => 'Modules/Imenu',
      'prodPackage' => 'imagina/imenu-module=v12.x-dev'
    ],
    [
      'name' => 'inotification',
      'git' => 'https://github.com/imagina/imaginacms-inotification.git',
      'path' => 'Modules/Inotification',
      'prodPackage' => 'imagina/inotification-module=v12.x-dev'
    ],
    [
      'name' => 'ipage',
      'git' => 'https://github.com/imagina/imaginacms-ipage.git',
      'path' => 'Modules/Ipage',
      'prodPackage' => 'imagina/ipage-module=v12.x-dev'
    ],
    [
      'name' => 'irentcar',
      'git' => 'https://github.com/imagina/imaginacms-irentcar.git',
      'path' => 'Modules/Irentcar',
      'prodPackage' => 'imagina/irentcar-module=v12.x-dev'
    ],
    [
      'name' => 'isetting',
      'git' => 'https://github.com/imagina/imaginacms-isetting.git',
      'path' => 'Modules/Isetting',
      'prodPackage' => 'imagina/isetting-module=v12.x-dev'
    ],
    [
      'name' => 'isite',
      'git' => 'https://github.com/imagina/imaginacms-isite.git',
      'path' => 'Modules/Isite',
      'prodPackage' => 'imagina/isite-module=v12.x-dev'
    ],
    [
      'name' => 'islider',
      'git' => 'https://github.com/imagina/imaginacms-islider.git',
      'path' => 'Modules/Islider',
      'prodPackage' => 'imagina/islider-module=v12.x-dev'
    ],
    [
      'name' => 'itranslation',
      'git' => 'https://github.com/imagina/imaginacms-itranslation.git',
      'path' => 'Modules/Itranslation',
      'prodPackage' => 'imagina/itranslation-module=v12.x-dev'
    ],
    [
      'name' => 'iuser',
      'git' => 'https://github.com/imagina/imaginacms-iuser.git',
      'path' => 'Modules/Iuser',
      'prodPackage' => 'imagina/iuser-module=v12.x-dev'
    ],
  ]
];
