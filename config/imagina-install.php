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
      'path' => 'packages/imagina/icore'
    ],
    [
      'name' => 'iworkshop',
      'git' => 'https://github.com/imagina/imaginacms-iworkshop.git',
      'path' => 'packages/imagina/iworkshop'
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
      'path' => 'Modules/Iblog'
    ],
    [
      'name' => 'ifillable',
      'git' => 'https://github.com/imagina/imaginacms-ifillable.git',
      'path' => 'Modules/Ifillable'
    ],
    [
      'name' => 'iform',
      'git' => 'https://github.com/imagina/imaginacms-iform.git',
      'path' => 'Modules/Iform'
    ],
    [
      'name' => 'ilocation',
      'git' => 'https://github.com/imagina/imaginacms-ilocation.git',
      'path' => 'Modules/Ilocation'
    ],
    [
      'name' => 'imedia',
      'git' => 'https://github.com/imagina/imaginacms-imedia.git',
      'path' => 'Modules/Imedia'
    ],
    [
      'name' => 'imenu',
      'git' => 'https://github.com/imagina/imaginacms-imenu.git',
      'path' => 'Modules/Imenu'
    ],
    [
      'name' => 'inotification',
      'git' => 'https://github.com/imagina/imaginacms-inotification.git',
      'path' => 'Modules/Inotification'
    ],
    [
      'name' => 'ipage',
      'git' => 'https://github.com/imagina/imaginacms-ipage.git',
      'path' => 'Modules/Ipage'
    ],
    [
      'name' => 'irentcar',
      'git' => 'https://github.com/imagina/imaginacms-irentcar.git',
      'path' => 'Modules/Irentcar'
    ],
    [
      'name' => 'isetting',
      'git' => 'https://github.com/imagina/imaginacms-isetting.git',
      'path' => 'Modules/Isetting'
    ],
    [
      'name' => 'isite',
      'git' => 'https://github.com/imagina/imaginacms-isite.git',
      'path' => 'Modules/Isite'
    ],
    [
      'name' => 'islider',
      'git' => 'https://github.com/imagina/imaginacms-islider.git',
      'path' => 'Modules/Islider'
    ],
    [
      'name' => 'itranslation',
      'git' => 'https://github.com/imagina/imaginacms-itranslation.git',
      'path' => 'Modules/Itranslation'
    ],
    [
      'name' => 'iuser',
      'git' => 'https://github.com/imagina/imaginacms-iuser.git',
      'path' => 'Modules/Iuser'
    ],
  ]
];
