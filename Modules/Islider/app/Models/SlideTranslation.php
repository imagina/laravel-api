<?php

namespace Modules\Islider\Models;

use Illuminate\Database\Eloquent\Model;

class SlideTranslation extends Model
{
  public $timestamps = false;
  protected $fillable = [
    'title',
    'caption',
    'uri',
    'url',
    'active',
    'custom_html',
    'summary',
    'code_ads'
  ];
  protected $table = 'islider__slide_translations';
}
