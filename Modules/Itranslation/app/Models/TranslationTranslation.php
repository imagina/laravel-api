<?php

namespace Modules\Itranslation\Models;

use Illuminate\Database\Eloquent\Model;

class TranslationTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'value'
    ];
    protected $table = 'itranslation__translation_translations';
}
